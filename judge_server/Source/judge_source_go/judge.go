package main;

import (
	"fmt"
	"os"
	"strconv"
	"regexp"
	"os/exec"
	"bytes"
)

type submitT struct {
	sessionID string;
	usercodePath string;
	testcaseDirPath string;
	execDirPath string;
	execFilePath string;
	score int;
	
	//0:C 1:C++ 2:Java8 3:Python3 4:C#
	lang int;

	//0:AC 1:WA 2:TLE 3:RE 4:MLE 5:CE 6:IE *Please reference atcoder.
	testcaseResult[50] int;
	overallResult int;

	testcaseTime[50] int;
	overallTime int;
	testcaseCnt int;
	memoryUsed int;
}

func checkRegexp(reg,str string) bool{
	return regexp.MustCompile(reg).Match([]byte(str));
}

func compile(submit *submitT) int{
	var (
		compileCmd *exec.Cmd;
		compileErr error;
		stderr bytes.Buffer;
	)

	switch(submit.lang){
		case 0://C11
			compileCmd=exec.Command("gcc",submit.execDirPath+"/Main.c","-lm","-std=gnu11","-o",submit.execDirPath+"/Main.out");
			submit.execFilePath=submit.execDirPath+"/Main.out";
		case 1://C++17
			compileCmd=exec.Command("g++",submit.execDirPath+"/Main.cpp","-lm","-std=gnu++17","-o",submit.execDirPath+"/Main.out");
			submit.execFilePath=submit.execDirPath+"/Main.out";
		case 2://java8
			compileCmd=exec.Command("javac",submit.execDirPath+"/Main.java","-d",submit.execDirPath);
			submit.execFilePath=submit.execDirPath+"/Main.class";
		case 3://python3
			//cmd:=exec.Command("python3","-m","py_compile",submit.execDirPath+"/Main.py","-lm","-std=gnu11","-o",submit.execDirPath,"2>",submit.execDirPath+"/err.txt");
			submit.execFilePath=submit.execDirPath+"/Main.py";
		case 4://C#
			compileCmd=exec.Command("mcs",submit.execDirPath+"/Main.cs","-out:"+submit.execDirPath+"/Main.exe");
			submit.execFilePath=submit.execDirPath+"/Main.exe";
	}
	compileCmd.Stderr=&stderr;
	compileErr=compileCmd.Run();
	if (compileErr!=nil){
		fmt.Fprintf(os.Stderr,stderr.String());
		return -1;
	}

	chownCmd:=exec.Command("chown","rbash_user",submit.execFilePath);chownErr:=chownCmd.Run();
	chmodCmd:=exec.Command("chmod","4777",submit.execFilePath);chmodErr:=chmodCmd.Run();
	if chownErr!=nil||chmodErr!=nil{
		fmt.Fprintf(os.Stderr,"failed to give permission\n");
		return -2;
	}

	return 0;
}

func tryTestcase(submit *submitT)int{
	testcaseListFp,err:=os.Open(submit.testcaseDirPath+"/testcase_list.txt");
	if err!=nil {
		fmt.Fprintf(os.Stderr,"failed to open"+submit.execDirPath+"/testcase_list.txt\n");
		return -1;
	}
	defer testcaseListFp.Close();

	var testcaseName [256]string;
	testcaseN:=0;
	buf:=make([]byte,1024);
	for i:=0;true;i++{
		n,readErr:=testcaseListFp.Read(buf);
		if n==0{
			break;
		}
		if readErr!=nil{
			fmt.Fprintf(os.Stderr,"failed to read"+submit.execDirPath+"/testcase_list.txt\n");
			break;
		}
		testcaseName[i]=string(buf[:n]);
		testcaseN++;
	}

	createContainerCmd:=exec.Command("docker","");

	for i:=0;i<testcaseN;i++{
		var runCmd *exec.Cmd;
		var runErr error;
		switch(submit.lang){
			case 0:
				runCmd=exec.Command("s")
		}
	}


	return 0;
}

func main() {
	var (
		result=[...]string{"AC","WA","TLE","RE","MLE","CE","IE"};
		lang=[...]string{".c",".cpp",".java",".py",".cs"};
		submit submitT;
		args=os.Args;
	)
	
	if (len(args)>6){
		fmt.Fprintf(os.Stdout,"%s,-1,undef,%s,0,",submit.sessionID,result[6]);
		fmt.Fprintf(os.Stderr,"too many args\n");
		return;
	}else if (len(args)<6){
		fmt.Fprintf(os.Stdout,"%s,-1,undef,%s,0,",submit.sessionID,result[6]);
		fmt.Fprintf(os.Stderr,"too few args\n");
		return;
	}

	/*validation_chack*/
	submit.sessionID=args[1];
	for i:=2;i<=5;i++ {
		if (checkRegexp("[^(A-Z|a-z|0-9|_|/|.)]",args[i])==true){
			fmt.Fprintf(os.Stdout,"%s,-1,undef,%s,0,",submit.sessionID,result[6]);
			fmt.Fprintf(os.Stderr,"Inputs are included another characters[0-9],[a-z],[A-Z],'.','/','_'\n");
			return;
		}
	}

	submit.usercodePath=args[2];
	submit.lang,_=strconv.Atoi(args[3]);
	submit.testcaseDirPath=args[4];
	submit.score,_=strconv.Atoi(args[5]);

	os.Mkdir("tmp/"+submit.sessionID,0755);
	submit.execDirPath="tmp/"+submit.sessionID;

	cpCmd:=exec.Command("cp",submit.usercodePath,submit.execDirPath);
	mvCmd:=exec.Command("mv",submit.execDirPath+"/"+submit.sessionID+lang[submit.lang],submit.execDirPath+"/Main"+lang[submit.lang]);
	cpErr:=cpCmd.Run();
	mvErr:=mvCmd.Run();
	if (cpErr!=nil || mvErr!=nil){
		fmt.Fprintf(os.Stderr,"failed to mv or cp\n");
		return ;
	}

	ret:=compile(&submit);
	if ret==-2{
		fmt.Fprintf(os.Stdout,"%s,-1,undef,%s,0,",submit.sessionID,result[6]);
		return;
	}else if ret==-1{
		fmt.Fprintf(os.Stdout,"%s,-1,undef,%s,0,",submit.sessionID,result[5]);
		return;
	}

	ret=tryTestcase(&submit);



	
}