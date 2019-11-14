#include <stdio.h>
#include <stdlib.h>
#include <string.h>

//within null bytes
#define MAX_ARGLEN 256

//within argv[0]
#define ARG_LEN 6

typedef struct Arguments_ {
    char sessionid[MAX_ARGLEN];
    char usercode_path[MAX_ARGLEN];
    char usercode_language[MAX_ARGLEN];
    char testcase_dir_path[MAX_ARGLEN];
    int point;
} Arguments;

//check arguments lengths
//return bool
int is_valid_arguments (const int argc, const char *argv[]) {

    if (argc < ARG_LEN){
        fprintf(stderr ,"too few arguments.");
        return 0;
    }

    if (argc > ARG_LEN){
        fprintf(stderr ,"too many arguments.");
        return 0;
    }

    for (int i = 0; i < ARG_LEN; i++) {
       if (strlen(argv[i]) >= MAX_ARGLEN){
           fprintf(stderr ,"too long arguments.");
           return 0;
       }
    }

    return 1;
}

//assign to &Arguments
void assign_arguments (Arguments *p_arguments, const char *argv[]){
    strcpy((char * restrict)(p_arguments->sessionid), argv[1]);
    strcpy((char * restrict)(p_arguments->usercode_path), argv[2]);
    strcpy((char * restrict)(p_arguments->usercode_language), argv[3]);
    strcpy((char * restrict)(p_arguments->testcase_dir_path), argv[4]);
    p_arguments->point = atoi(argv[4]);
}

int main (const int argc, const char *argv[]) {
    //initialize
    if (!is_valid_arguments (argc, argv)) {
        exit(1);
    }   
    Arguments arguments;
    assign_arguments (&arguments, argv);
    
#ifdef DEBUG_INPUT
    printf("%s,%s,%s,%s,%s", arguments.sessionid, arguments.usercode_path, arguments.usercode_language, arguments.testcase_dir_path,arguments.point);
#endif
    //todo random output for test
    //sessionid,runtime(ms),[maxmemory(kb)|undef],[AC|WA|TLE|RE|CE],point_weight[0.0-1.0],output1[AC|WA|TLE|RE|CE],output1time(ms),outputs2[AC|WA|TLE|RE|CE],ouput2time,outputs3[AC|WA|TLE|RE|CE],...
    printf("%s,321,undef,AC,%d,AC,123,AC,223,AC,443,AC,554,", arguments.sessionid, arguments.point);
    return 0;
}
