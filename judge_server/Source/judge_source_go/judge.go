package main

import (
	"fmt"
	"io"
	"io/ioutil"
	"os"
	"os/exec"
	"regexp"
	"strconv"
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
	lang int

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
		cpUsercodeCmd *exec.Cmd
		compileCmd    *exec.Cmd
	)

	exec.Command("docker", "exec", "-it", "ubuntuForJudge", "/bin/bash", "-c", "\"mkdir /cafecoderUsers/\""+submit.sessionID).Run()
	switch submit.lang {
	case 0: //C11
		cpUsercodeCmd = exec.Command("docker", "cp", submit.usercodePath, "ubuntuForJudge:/cafecoderUsers/"+submit.sessionID+"/Main.c")
		compileCmd = exec.Command("docker", "exec", "-it", "ubuntuForJudge", "gcc", "/cafecoderUsers/"+submit.sessionID+"/Main.c", "-lm", "-std=gnu11", "-o", "/cafecoderUsers/"+submit.sessionID+"/Main.out")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.out"
	case 1: //C++17
		cpUsercodeCmd = exec.Command("docker", "cp", submit.usercodePath, "ubuntuForJudge:/cafecoderUsers/"+submit.sessionID+"/Main.cpp")
		compileCmd = exec.Command("docker", "exec", "-it", "ubuntuForJudge", "g++", "/cafecoderUsers/"+submit.sessionID+"/Main.cpp", "-lm", "-std=gnu++17", "-o", "/cafecoderUsers/"+submit.sessionID+"/Main.out")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.out"
	case 2: //java8
		cpUsercodeCmd = exec.Command("docker", "cp", submit.usercodePath, "ubuntuForJudge:/cafecoderUsers/"+submit.sessionID+"/Main.java")
		compileCmd = exec.Command("docker", "exec", "-it", "ubuntuForJudge", "javac", "/cafecoderUsers/"+submit.sessionID+"/Main.java", "-d", "/cafecoderUsers/"+submit.sessionID)
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.class"
	case 3: //python3
		cpUsercodeCmd = exec.Command("docker", "cp", submit.usercodePath, "ubuntuForJudge:/cafecoderUsers/"+submit.sessionID+"/Main.py")
		//cmd:=exec.Command("python3","-m","py_compile",submit.execDirPath+"/Main.py","-lm","-std=gnu11","-o",submit.execDirPath,"2>",submit.execDirPath+"/err.txt");
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.py"
	case 4: //C#
		cpUsercodeCmd = exec.Command("docker", "cp", submit.usercodePath, "ubuntuForJudge:/cafecoderUsers/"+submit.sessionID+"/Main.cs")
		compileCmd = exec.Command("docker", "exec", "-it", "ubuntuForJudge", "mcs", "/cafecoderUsers/"+submit.sessionID+"/Main.cs", "-out:/cafecoderUsers/"+submit.sessionID+"/Main.exe")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.exe"
	case 5: //Ruby
		cpUsercodeCmd = exec.Command("docker", "cp", submit.usercodePath, "ubuntuForJudge:/cafecoderUsers/"+submit.sessionID+"/Main.rb")
		compileCmd = exec.Command("docker", "exec", "-it", "ubuntuForJudge", "ruby", "-cw", "/cafecoderUsers/"+submit.sessionID+"/Main.rb")
		submit.execFilePath = "/cafecoderUsers/" + submit.sessionID + "/Main.rb"
	}
	cpUsercodeCmd.Run()
	compileOut, err := compileCmd.Output()
	if err != nil {
		fmt.Fprintf(os.Stderr, "%s\n", err)
		return -1
	}
	fmt.Fprintf(os.Stderr, "%s\n", string(compileOut))

	chownErr := exec.Command("docker", "exec", "-it", "ubuntuForJudge", "chown", "rbash_user", submit.execFilePath).Run()
	chmodErr := exec.Command("docker", "exec", "-it", "ubuntuForJudge", "chmod", "4777", submit.execFilePath).Run()
	if chownErr != nil || chmodErr != nil {
		fmt.Fprintf(os.Stderr, "failed to give permission\n")
		return -2
	}

	return 0
}

func tryTestcase(submit *submitT) int {
	testcaseListFp, err := os.Open(submit.testcaseDirPath + "/testcase_list.txt")
	if err != nil {
		fmt.Fprintf(os.Stderr, "failed to open"+submit.testcaseDirPath+"/testcase_list.txt\n")
		return -1
	}

	defer testcaseListFp.Close()

	var testcaseName [256]string
	testcaseN := 0
	buf := make([]byte, SIZE)
	for i := 0; true; i++ {
		n, readErr := testcaseListFp.Read(buf)
		if n == 0 {
			break
		}
		if readErr != nil {
			fmt.Fprintf(os.Stderr, "failed to read"+submit.execDirPath+"/testcase_list.txt\n")
			break
		}
		testcaseName[i] = string(buf[:n])
		testcaseN++
	}
	submit.testcaseCnt = testcaseN

	var executeUsercodeCmd *exec.Cmd
	switch submit.lang {
	case 0: //C11
		executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", ".", submit.execFilePath)
	case 1: //C++17
		executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", ".", submit.execFilePath)
	case 2: //java8
		executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", ".", submit.execFilePath)
	case 3: //python3
		executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", ".", submit.execFilePath)
	case 4: //C#
		executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", ".", submit.execFilePath)
	case 5: //Ruby
		executeUsercodeCmd = exec.Command("docker", "exec", "-i", "ubuntuForJudge", "timeout", "3", ".", submit.execFilePath)
	}
	submit.overallTime = 0
	submit.overallResult = 0
	for i := 0; i < testcaseN; i++ {
		inputTestcase, err := ioutil.ReadFile(submit.testcaseDirPath + "/in/" + testcaseName[i])
		if err != nil {
			fmt.Fprintf(os.Stderr, "%s\n", err)
			return -1
		}
		outputTestcase, err := ioutil.ReadFile(submit.testcaseDirPath + "/out/" + testcaseName[i])
		if err != nil {
			fmt.Fprintf(os.Stderr, "%s\n", err)
			return -1
		}
		stdin, err := executeUsercodeCmd.StdinPipe()
		if err != nil {
			fmt.Fprintf(os.Stderr, "%s\n", err)
			return -1
		}
		io.WriteString(stdin, string(inputTestcase))
		stdin.Close()

		startTime := time.Now()
		userOut, runtimeErr := executeUsercodeCmd.Output()
		endTime := time.Now()
		if err != nil {
			fmt.Fprintf(os.Stderr, "%s\n", err)
			return -1
		}

		submit.testcaseTime[i] = endTime.Sub(startTime).Milliseconds()
		if submit.overallTime < submit.testcaseTime[i] {
			submit.overallTime = submit.testcaseTime[i]
		}
		if submit.testcaseTime[i] <= 2000 {
			if runtimeErr != nil {
				submit.testcaseResult[i] = 3 //RE
			} else {
				if string(userOut) == string(outputTestcase) {
					submit.testcaseResult[i] = 0 //AC
				} else {
					submit.testcaseResult[i] = 1 //WA
				}
			}
		} else {
			submit.testcaseResult[i] = 2 //TLE
		}
		if submit.testcaseResult[i] < submit.overallResult {
			submit.testcaseResult[i] = submit.overallResult
		}
	}
	return 0
}

func main() {
	var (
		result = [...]string{"AC", "WA", "TLE", "RE", "MLE", "CE", "IE"}
		//lang   = [...]string{".c", ".cpp", ".java", ".py", ".cs", ".rb"}
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

	//exec.Command("docker", "start", "ubuntuForJudge").Run()

	submit.usercodePath = args[2]
	submit.lang, _ = strconv.Atoi(args[3])
	submit.testcaseDirPath = args[4]
	submit.score, _ = strconv.Atoi(args[5])

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
		fmt.Fprintf(os.Stdout, "%s,%d,undef,%s,%d,", submit.sessionID, submit.overallTime, result[submit.overallResult], submit.score)
		for i := 0; i < submit.testcaseCnt; i++ {
			fmt.Fprintf(os.Stdout, "%s,%d,", result[submit.testcaseResult[i]], submit.testcaseTime[i])
		}
	}
}
