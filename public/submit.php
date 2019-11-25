<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>提出</title>
    <script type="text/javascript" src="https://www.kakecoder.com/enable_tab.js"></script>
    <link rel="stylesheet" type="text/css" href="https://www.kakecoder.com/index.css">
</head>

<body>
    
<?php
if(!isset($_SESSION["username"]) || $_SESSION["username"] == ""){
    echo "サインインしてください。";
    exit();
}

$ext = array(
    "0"=>"c",
    "1"=>"cpp",
    "2"=>"java",
    "3"=>"py",
    "4"=>"cs",
);

$problem = array(
    "A"=>"A",
    "B"=>"B",
    "C"=>"C",
    "D"=>"D",
    "E"=>"E",
    "F"=>"F",
);


if($ext[$_POST["language"]] == "" || !isset($_POST["language"]) || !isset($_POST["problem"]) || !isset($_POST["sourcecode"]) || !isset($_POST["contest_id"])){
    echo "不適切なリクエストです。";
    exit();
}
if(!preg_match("/^[0-9a-zA-Z]+$/",$_POST["contest_id"])){
    echo "contest_idが不正です。";
    exit();
}
//get file extention 
//init session
$language = $_POST["language"];
$code_session = md5(rand());
$contest_id = $_POST["contest_id"];
$problem = $problem[$_POST["problem"]];
$_SESSION["problem"] = $problem;
$_SESSION["code_session"] = $code_session;
$code_dir = "./users/".$_SESSION["username"]."/codes/$contest_id/$problem/";
include_once "../database/connection.php";
try{
$con = new DBC();
}catch(Exception $e){
    echo "DB INIT ERROR";
    exit();
}
//point and testcase_dir
try{
$rec = $con->prepare_execute("SELECT point,testcase_list_dir FROM problem WHERE contest_id=? AND problem_id=?",array($contest_id, $problem))[0];
}catch(Exception $e){
    var_dump("");
    echo "DB SELECT ERROR 1";
    exit();
}
$point = $rec["point"];
$testcase_dir = $rec["testcase_list_dir"];
//make code dir
if (!file_exists($code_dir.".")){
    mkdir($code_dir,0755,TRUE);
}
$code_path = realpath($code_dir)."/".$code_session.".".$ext[$_POST["language"]];
$_SESSION["code_path"] = $code_path;
//put code text
file_put_contents($code_path, $_POST["sourcecode"]);
/*
todo
sesssion to mysql 
*/
$date = new DateTime();
$nowtime = $date->format('Y-m-d H:i:s');
$con = new DBC();
try{
    $con->prepare_execute("INSERT INTO uploads (code_session, contest_id, problem, user_id, upload_date,lang) VALUES (?, ?, ?, ?, ?, ?)", array($code_session, $contest_id , $problem, $_SESSION["uid"], $nowtime, $language));
}catch(Exception $e){
    // var_dump($e);
    echo "エラーが発生しました。もう一度提出してください。: DB INSERT ERROR";
    exit();
}
//call
exec("../judge_server/JUDGE $code_session $code_path ".$language." $testcase_dir $point > ".$code_dir.$code_session.".result 2> ".$code_dir.$code_session.".error &");
header("Location: /result.php?username=".$_SESSION["username"]."&code_session=".$code_session."&contest_id=".$contest_id);
exit();
?>


</html>
