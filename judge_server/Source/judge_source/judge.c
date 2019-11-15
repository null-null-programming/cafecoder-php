/*----------------------------------------------------------------------------
*last update:2019/11/15
*author:earlgray283
*comment:
 ・提出言語がpython3だったときはコンパイルチェックをしません。
　 うまくコンパイルができなかったので、もしもCE状態で提出されたとしても
　 RE扱いになります。(要検証)
 ・mkdirをシェル上で実行することにしました(要検証)
 ・input_validation_checker()を修正しました。正直なにがだめだったのかがわかりません
 ・C#のコンパイルコマンド・実行コマンドを追加しました。

----------------------------------------------------------------------------*/

#include<stdio.h>
#include<stdlib.h>
#include<string.h>
#include<time.h>
#include<sys/time.h>
#include<sys/stat.h>
#include<sys/types.h>
#include<unistd.h>


typedef long long int ll;
typedef struct submit_{
    time_t submit_time;
    char sessionID[256];
    char usercode_path[256];
    char testcase_dir_path[256];
    int score;
    
    //0:C 1:C++ 2:Java8 3:Python3 4:C#
    int lang;

    //0:AC 1:WA 2:TLE 3:RE 4:MLE 5:CE 6:IE *Please reference atcoder.
    int testcase_result[50];
    int overall_result;
   
    int testcase_time[50];
    int overall_time;
    int testcase_cnt;
    int memory_used;
}submit_t;

//提出コードをコンパイルします。
int compile(submit_t*);
//rbash_userとして実行できるようにします。
int permit(submit_t);
//テストケースの入力をしてジャッジをします。
int try_testcase(submit_t*);
//tmp下のセッションidごとにわかれたdirを削除します。
void clean_up(char*);
//[a-z],[A-Z],[0-9],'/','.'以外の文字が入っていた時、ジャッジを終了します
int input_validation_checker(submit_t);

int main(int argc,char *argv[]){
    setuid(0);
    submit_t submit;
    memset(&submit,0,sizeof(submit));//initialize with 0
    char *result[7]={"AC","WA","TLE","RE","MLE","CE","IE"};
    
    if(argc>6){
        fprintf(stdout,"%s,-1,undef,IE,0,",submit.sessionID);
        fprintf(stderr,"too many args");
        return -1;
    }else if(argc<6){
        fprintf(stdout,"%s,-1,undef,IE,0,",submit.sessionID);
        fprintf(stderr,"too few args");
        return -1;
    }

    strcpy(submit.sessionID,argv[1]);
    strcpy(submit.usercode_path,argv[2]);
    submit.lang=atoi(argv[3]);
    strcpy(submit.testcase_dir_path,argv[4]);
    submit.score=atoi(argv[5]);
    if(input_validation_checker(submit)){
        fprintf(stdout,"%s,-1,undef,IE,0,",submit.sessionID);
        fprintf(stderr,"Inputs are included another characters[0-9],[a-z],[A-Z],'.','/'");
        return -1;
    }

    //*シェル上でmkdirを実行するとうまくいったのでとりあえずこうしましたが、
    //*よくないということは分かっているので落ち着いたら検証します。
    char mkdir_cmd[1000];
    //sprintf(mkdir_cmd,"tmp/%s",submit.sessionID);
    sprintf(mkdir_cmd,"mkdir -m 755 tmp/%s",submit.sessionID);
    //mkdir("tmp",0777);
    //mkdir(mkdir_cmd,__S_IREAD|__S_IWRITE);
    system(mkdir_cmd);
    
    int ret;
    ret=compile(&submit);
    if(ret==-1){
        fprintf(stdout,"%s,-1,undef,IE,0,",submit.sessionID);
        fprintf(stderr,"unknown language");
        clean_up(submit.sessionID);
        return -1;
    }else if(ret){
        fprintf(stdout,"%s,-1,undef,CE,0,",submit.sessionID);
        clean_up(submit.sessionID);
        return -1;
    }
    
    permit(submit);
    ret=try_testcase(&submit);
    if(ret==-1){
        fprintf(stdout,"%s,-1,undef,IE,0,",submit.sessionID);
        fprintf(stderr,"couldn't create tmp files.");
        clean_up(submit.sessionID);
        return -1;
    }else{
        if(!submit.overall_result){
            fprintf(stdout,"%s,%d,undef,%s,%d,",submit.sessionID,submit.overall_time,result[submit.overall_result],submit.score);
            for(int i=0;i<submit.testcase_cnt;i++){
                fprintf(stdout,"%s,%d,",result[submit.testcase_result[i]],submit.testcase_time[i]);
            }
        }else{
            fprintf(stdout,"%s,%d,undef,%s,0,",submit.sessionID,submit.overall_time,result[submit.overall_result]);
            for(int i=0;i<submit.testcase_cnt;i++){
                fprintf(stdout,"%s,%d,",result[submit.testcase_result[i]],submit.testcase_time[i]);
            }
        }
    }
    //clean_up(submit.sessionID);
    return 0;
}

int compile(submit_t* submit){
    char compile_command[5000];
    char tmp[5000];
    int system_return;
    switch(submit->lang){
        case 0://C11
            sprintf(compile_command,"gcc %s -lm -std=gnu11 -o tmp/%s/Main.out 2> tmp/%s/err.txt",submit->usercode_path,submit->sessionID,submit->sessionID);
            break;
        case 1://C++17
            sprintf(compile_command,"g++ %s -lm -std=gnu++17 -o tmp/%s/Main.out 2> tmp/%s/err.txt",submit->usercode_path,submit->sessionID,submit->sessionID);
            break;
        case 2://Java8
            sprintf(tmp,"cp %s tmp/%s",submit->usercode_path,submit->sessionID);
            system(tmp);
            sprintf(tmp,"mv tmp/%s/%s.java tmp/%s/Main.java",submit->sessionID,submit->sessionID,submit->sessionID);
            system(tmp);
            sprintf(compile_command,"javac tmp/%s/Main.java -d tmp/%s 2> tmp/%s/err.txt",submit->sessionID,submit->sessionID,submit->sessionID);
            break;
        case 3://Python3
            sprintf(compile_command,"python3 -m py_compile %s -d tmp/%s 2> tmp/%s/err.txt",submit->usercode_path,submit->sessionID,submit->sessionID);
            break;
        case 4://C#
            sprintf(compile_command,"mcs %s -out:tmp/%s/Main.exe 2> tmp/%s/err.txt",submit->usercode_path,submit->sessionID,submit->sessionID);
            break;
        default:
            fprintf(stderr,"error\n");
            return -1;
    }

    int ret=0;
    if(submit->lang!=3)ret=system(compile_command);
    
    //get standard error
    char err_path[600];sprintf(err_path,"tmp/%s/err.txt",submit->sessionID);
    char buf[600];
    FILE *fp=fopen(err_path,"r");
    if(fp!=NULL){
        while(fscanf(fp,"%s",buf)!=EOF){
            fprintf(stderr,"%s\n",buf);
        }
        fclose(fp);
    }
    
    remove(err_path);

    return ret;
}

int permit(submit_t submit){
    char Main_path[1000];
    if(submit.lang!=3)sprintf(Main_path,"tmp/%s/Main.out",submit.sessionID);
    else sprintf(Main_path,"%s",submit.usercode_path);
    char cmd[1000];
    sprintf(cmd,"chown rbash_user %s",Main_path);
    system(cmd);
    sprintf(cmd,"chmod 4777 %s",Main_path);
    system(cmd);
}

int try_testcase(submit_t *submit){
    char testcase_list[1000];
    sprintf(testcase_list,"%s/testcase_list.txt",submit->testcase_dir_path);

    FILE *fp=fopen(testcase_list,"r");
    if(fp==NULL){
        return -1;
    }
    

    int cnt=0;
    char buf[256],testcase_in[1000],testcase_out[1000],user_out[1000],execute_command[1000];
    while(fscanf(fp,"%s",buf)!=EOF){
        sprintf(testcase_in,"%s/in/%s",submit->testcase_dir_path,buf);
        sprintf(testcase_out,"%s/out/%s",submit->testcase_dir_path,buf);
        sprintf(user_out,"tmp/%s/user_out.txt",submit->sessionID);
        
        switch(submit->lang){
            case 0://C
                sprintf(execute_command,"sudo -u rbash_user timeout 4 ./tmp/%s/Main.out < %s > tmp/%s/user_out.txt"
                                                                    ,submit->sessionID,testcase_in,submit->sessionID);
                break;
            case 1://C++
                sprintf(execute_command,"sudo -u rbash_user timeout 4 ./tmp/%s/Main.out < %s > tmp/%s/user_out.txt"
                                                                    ,submit->sessionID,testcase_in,submit->sessionID);
                break;
            case 2://Java8
                sprintf(execute_command,"sudo -u rbash_user timeout 4 java -cp ./tmp/%s Main < %s > tmp/%s/user_out.txt"
                                                                    ,submit->sessionID,testcase_in,submit->sessionID);
                break;
            case 3://Python3
                sprintf(execute_command,"sudo -u rbash_user timeout 4 python3 %s < %s > tmp/%s/user_out.txt"
                                                                    ,submit->usercode_path,testcase_in,submit->sessionID);
                break;
            case 4://C#
                sprintf(execute_command,"sudo -u rbash_user timeout 4 mono ./tmp/%s/Main.exe < %s > tmp/%s/user_out.txt"
                                                                    ,submit->sessionID,testcase_in,submit->sessionID);
                break;
            default:
                fprintf(stderr,"error\n");
                return -1;
        }

        /*------------------execute user's program------------------*/
        struct timeval start,end;
        gettimeofday(&start,NULL);

        int ret=system(execute_command);

        gettimeofday(&end,NULL);
        int time=(end.tv_sec-start.tv_sec)*1000+(end.tv_usec-start.tv_usec)/1000;
        /*----------------------------------------------------------*/

        if(time<=2000){
            if(ret){
                submit->testcase_result[cnt]=3;//RE
            }else{
                char user_output[256],testcase_output[256];
                FILE *user_out_fp=fopen(user_out,"r");
                FILE *testcase_out_fp=fopen(testcase_out,"r");

                if(user_out_fp==NULL||testcase_out_fp==NULL){
                    return -1;
                }

                submit->testcase_result[cnt]=1;//WA
                while(fscanf(user_out_fp,"%s",user_output)!=EOF&&fscanf(testcase_out_fp,"%s",testcase_output)!=EOF){
                    submit->testcase_result[cnt]=0;//AC
                    if(strcmp(user_output,testcase_output)){
                        submit->testcase_result[cnt]=1;//WA
                        break;
                    }
                }

                fclose(user_out_fp);
                fclose(testcase_out_fp);
            }
        }else{
            submit->testcase_result[cnt]=2;//TLE
        }

        submit->testcase_time[cnt]=time;
        if(submit->overall_time<time)submit->overall_time=time;
        if(submit->overall_result<submit->testcase_result[cnt])submit->overall_result=submit->testcase_result[cnt];
        cnt++;
    }
    submit->testcase_cnt=cnt;
    fclose(fp);

    return 0;
}

void clean_up(char *sessionid){
    char cmd[1000];sprintf(cmd,"rm -rf tmp/%s",sessionid);
    system(cmd);
}

int input_validation_checker(submit_t submit){
    char *ptr;
    for(ptr=submit.sessionID;*ptr!='\0';ptr++){
        if(!(('a'<=*ptr&&*ptr<='z')||('A'<=*ptr&&*ptr<='Z')||('0'<=*ptr&&*ptr<='9')||*ptr=='/'||*ptr=='.')){
            return 1;
        }
    }
    for(ptr=submit.testcase_dir_path;*ptr!='\0';ptr++){
        if(!(('a'<=*ptr&&*ptr<='z')||('A'<=*ptr&&*ptr<='Z')||('0'<=*ptr&&*ptr<='9')||*ptr=='/'||*ptr=='.')){
            return 1;
        }
    }
    for(ptr=submit.usercode_path;*ptr!='\0';ptr++){
        if(!(('a'<=*ptr&&*ptr<='z')||('A'<=*ptr&&*ptr<='Z')||('0'<=*ptr&&*ptr<='9')||*ptr=='/'||*ptr=='.')){
            return 1;
        }
    }
    return 0;
}