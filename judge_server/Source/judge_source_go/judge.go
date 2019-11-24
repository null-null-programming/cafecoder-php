package main

import (
	"bufio"
	"bytes"
	"fmt"
	"io"
	"io/ioutil"
	"os"
	"os/exec"
	"regexp"
	"strconv"
	"strings"
	"time"
)

const (
	//SIZE of buffer
	SIZE = 65536
)

type submitT struct {
	sessionID       string
	usercodePath    string
	testcaseDirPath string
	execDirPath     string
	execFilePath    string
	score           int

	//0:C 1:C++ 2:Java8 3:Python3 4:C#
	lang          int
	langExtention string

	//0:AC 1:WA 2:TLE 3:RE 4:MLE 5:CE 6:IE *Please reference atcoder.
	testcaseResult [50]int
	overallResult  int

	testcaseTime [50]int64
	overallTime  int64
	testcaseCnt  int
	memoryUsed   int
}

func checkRegexp(reg, str string) bool {
	return regexp.MustCompile(reg).Match([]byte(str))
}

func compile(submit *submitT) int {
	var (
		//cpUsercodeCmd *exec.Cmd
		compileCmd *exec.Cmd
		stderr     bytes.Buffer
	)

	mkdirCmd := exec.Command("docker", "exec", "-i", "ubuntuForJudge", "/bin/bash", "-c", "mkdir cafecoderUsers/"+submit.sessionID)
	mkdirCmd.Stderr = &stderr
	err := mkdirCmd.Run()
	if err != nil {
		fmt.Fprintf(os.Stderr, "couldn't execute next command \"mkdir cafecoderUsers/****\"\n")
		fmt.Fprintf(os.Stderr, "%s\n", stderr.String())
		return -2
	}

	cpCmd := exec.Command("docker", "cp", submit.usercodePath, "ubuntuForJudge:/cafecoderUsers/"+submit.sessionID+"/Main"+submit.langExtention)
	cpCmd.Stderr = &stderr
	err = cpCmd.Run()
	if err != nil {
		fmt.Fprintf(os.Stderr, "%s", stderr.String())
	}
	switch submit.lang {
	case 0: //C11
		compileCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "gcc", "/cafecoderUsers/"+submit.sessionID+"/Main.c", "-lm", "-std=gnu11", "-o", "/cafecoderUsers/"+submit.sessionID+"/Main.out")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.out"
		submit.execDirPath = "/cafecoderUsers/" + submit.sessionID
	case 1: //C++17
		compileCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "g++", "/cafecoderUsers/"+submit.sessionID+"/Main.cpp", "-lm", "-std=gnu++17", "-o", "/cafecoderUsers/"+submit.sessionID+"/Main.out")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.out"
		submit.execDirPath = "/cafecoderUsers/" + submit.sessionID
	case 2: //java8
		compileCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "javac", "/cafecoderUsers/"+submit.sessionID+"/Main.java", "-d", "/cafecoderUsers/"+submit.sessionID)
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.class"
		submit.execDirPath = "/cafecoderUsers/" + submit.sessionID
	case 3: //python3
		compileCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "python3", "-m", "py_compile", "/cafecoderUsers/"+submit.sessionID+"/Main.py")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.py"
		submit.execDirPath = "/cafecoderUsers/" + submit.sessionID
	case 4: //C#
		compileCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "mcs", "/cafecoderUsers/"+submit.sessionID+"/Main.cs", "-out:/cafecoderUsers/"+submit.sessionID+"/Main.exe")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.exe"
		submit.execDirPath = "/cafecoderUsers/" + submit.sessionID
	case 5: //Ruby
		compileCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "ruby", "-cw", "/cafecoderUsers/"+submit.sessionID+"/Main.rb")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.rb"
		submit.execDirPath = "/cafecoderUsers/" + submit.sessionID
	}

	compileCmd.Stderr = &stderr
	if submit.lang != 5 {
		err = compileCmd.Run()
		if err != nil {
			fmt.Fprintf(os.Stderr, "%s\n", stderr.String())
			return -1
		}
	}

	chownErr := exec.Command("docker", "exec", "-i", "ubuntuForJudge", "chown", "rbash_user", submit.execFilePath).Run()
	chmodErr := exec.Command("docker", "exec", "-i", "ubuntuForJudge", "chmod", "4777", submit.execFilePath).Run()
	if chownErr != nil || chmodErr != nil {
		fmt.Fprintf(os.Stderr, "failed to give permission\n")
		return -2
	}

	return 0
}

func tryTestcase(submit *submitT) int {
	var (
		stderr     bytes.Buffer
		runtimeErr error
		userOut    []byte
	)

	testcaseListFp, err := os.Open(submit.testcaseDirPath + "/testcase_list.txt")
	if err != nil {
		fmt.Fprintf(os.Stderr, "failed to open"+submit.testcaseDirPath+"/testcase_list.txt\n")
		return -1
	}

	defer testcaseListFp.Close()

	var testcaseName [256]string
	scanner := bufio.NewScanner(testcaseListFp)
	testcaseN := 0
	for scanner.Scan() {
		testcaseName[testcaseN] = scanner.Text()
		testcaseN++
	}
	submit.testcaseCnt = testcaseN

	submit.overallTime = 0
	submit.overallResult = 0

	if err != nil {
		fmt.Fprintf(os.Stderr, "%s\n", err)
		return -1
	}

	for i := 0; i < testcaseN; i++ {
		var executeUsercodeCmd *exec.Cmd
		switch submit.lang {
		case 0: //C11
			executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", "."+submit.execFilePath)
		case 1: //C++17
			executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", "."+submit.execFilePath)
		case 2: //java8
			executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", "java", "-cp", "."+submit.execDirPath, "Main")
		case 3: //python3
			executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", "python3", submit.execFilePath)
		case 4: //C#
			executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", "mono", "."+submit.execFilePath)
		case 5: //Ruby
			executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", "ruby", submit.execFilePath)
		}

		stdin, err := executeUsercodeCmd.StdinPipe()
		testcaseName[i] = strings.TrimSpace(testcaseName[i]) //delete \n\r
		inputTestcase, err := ioutil.ReadFile(submit.testcaseDirPath + "/in/" + testcaseName[i])
		if err != nil {
			fmt.Fprintf(os.Stderr, "[%s]-->%s\n", testcaseName[i], err)
			return -1
		}
		outputTestcase, err := ioutil.ReadFile(submit.testcaseDirPath + "/out/" + testcaseName[i])
		if err != nil {
			fmt.Fprintf(os.Stderr, "%s\n", err)
			return -1
		}

		io.WriteString(stdin, string(inputTestcase))
		stdin.Close()

		executeUsercodeCmd.Stderr = &stderr

		startTime := time.Now().UnixNano()
		userOut, runtimeErr = executeUsercodeCmd.Output()
		endTime := time.Now().UnixNano()

		submit.testcaseTime[i] = (endTime - startTime) / 1000000
		if submit.overallTime < submit.testcaseTime[i] {
			submit.overallTime = submit.testcaseTime[i]
		}
		userOutLines := strings.Split(string(userOut), "\n")
		outputTestcaseLines := strings.Split(string(outputTestcase), "\n")

		if submit.testcaseTime[i] <= 2000 {
			if runtimeErr != nil {
				fmt.Fprintf(os.Stderr, "%s\n", runtimeErr)
				fmt.Fprintf(os.Stderr, "%s\n", stderr.String())
				submit.testcaseResult[i] = 3 //RE
			} else {
				submit.testcaseResult[i] = 1 //WA
				for j := 0; j < len(userOutLines) && j < len(outputTestcaseLines); j++ {
					submit.testcaseResult[i] = 0 //AC
					if string(userOutLines[j]) != string(outputTestcaseLines[j]) {
						submit.testcaseResult[i] = 1 //WA
						break
					}
				}
			}
		} else {
			submit.testcaseResult[i] = 2 //TLE
		}
		if submit.testcaseResult[i] > submit.overallResult {
			submit.overallResult = submit.testcaseResult[i]
		}
	}
	return 0
}

func deleteUserDir(submit submitT) {
	exec.Command("docker", "exec", "-i", "ubuntuForJudge", "rm", "-r", "cafecoderUsers/"+submit.sessionID).Run()
}

func deleteUserCode(submit submitT) {
	exec.Command("docker", "exec", "-i", "ubuntuForJudge", "rm", "cafecoderUsers/"+submit.sessionID+"/Main"+submit.langExtention).Run()
}

func main() {
	var (
		result = [...]string{"AC", "WA", "TLE", "RE", "MLE", "CE", "IE"}
		lang   = [...]string{".c", ".cpp", ".java", ".py", ".cs", ".rb"}
		submit submitT
		args   = os.Args
	)

	if len(args) > 6 {
		fmt.Fprintf(os.Stdout, "%s,-1,undef,%s,0,", submit.sessionID, result[6])
		fmt.Fprintf(os.Stderr, "too many args\n")
		return
	} else if len(args) < 6 {
		fmt.Fprintf(os.Stdout, "%s,-1,undef,%s,0,", submit.sessionID, result[6])
		fmt.Fprintf(os.Stderr, "too few args\n")
		return
	}

	/*validation_chack*/
	submit.sessionID = args[1]
	for i := 2; i <= 5; i++ {
		if checkRegexp("[^(A-Z|a-z|0-9|_|/|.)]", args[i]) == true {
			fmt.Fprintf(os.Stdout, "%s,-1,undef,%s,0,", submit.sessionID, result[6])
			fmt.Fprintf(os.Stderr, "Inputs are included another characters[0-9],[a-z],[A-Z],'.','/','_'\n")
			return
		}
	}

	submit.usercodePath = args[2]
	submit.lang, _ = strconv.Atoi(args[3])
	submit.testcaseDirPath = args[4]
	submit.score, _ = strconv.Atoi(args[5])
	submit.langExtention = lang[submit.lang]

	defer deleteUserDir(submit)

	ret := compile(&submit)
	if ret == -2 {
		fmt.Fprintf(os.Stdout, "%s,-1,undef,%s,0,", submit.sessionID, result[6])
		return
	} else if ret == -1 {
		fmt.Fprintf(os.Stdout, "%s,-1,undef,%s,0,", submit.sessionID, result[5])
		return
	}
	ret = tryTestcase(&submit)
	if ret == -1 {
		fmt.Fprintf(os.Stdout, "%s,-1,undef,%s,0,", submit.sessionID, result[6])
	} else {
		fmt.Fprintf(os.Stdout, "%s,%d,undef,%s,", submit.sessionID, submit.overallTime, result[submit.overallResult])
		if submit.overallResult == 0 {
			fmt.Fprintf(os.Stdout, "%d,", submit.score)
		} else {
			fmt.Fprintf(os.Stdout, "0,")
		}
		for i := 0; i < submit.testcaseCnt; i++ {
			fmt.Fprintf(os.Stdout, "%s,%d,", result[submit.testcaseResult[i]], submit.testcaseTime[i])
		}
	}
}
