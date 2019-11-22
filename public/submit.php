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
include "signin.php";
if(!isset($_SESSION["username"]) || $_SESSION["username"] == ""){
    echo "サインインしてください。";
    exit();
}
echo "一時停止中。";

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
);


var_dump($_POST);
if($ext[$_POST["language"]] == "" || !isset($_POST["language"]) || !isset($_POST["problem"]) || !isset($_POST["sourcecode"])){
    echo "不適切なリクエストです。";
    exit();
}
//get file extention 
//init session
$code_session = md5(rand());
$problem = $problem[$_POST["problem"]];
$_SESSION["problem"] = $problem;
$_SESSION["code_session"] = $code_session;
$code_dir = "./users/".$_SESSION["username"]."/codes/$problem/";
//test
$point = 100;

//make code dir
if (!file_exists($code_dir.".")){
    mkdir($code_dir,0777,TRUE);
}
$code_path = realpath($code_dir)."/".$code_session.".".$ext[$_POST["language"]];
$_SESSION["code_path"] = $code_path;
//put code text
file_put_contents($code_path, $_POST["sourcecode"]);

$testcase_dir_path = realpath("../Contests/tea002/$problem/");
/*
todo
sesssion to mysql 
*/
$con = new DBC();
try{
    $con->prepare_execute("INSERT INTO tea002uploads (uid, problem, code_session, user_id) VALUES (?, ?, ?, ?)", array(md5(rand()), $problem, $code_session, $_SESSION["uid"]));
}catch(Exception $e){
    // var_dump($e);
    echo "エラーが発生しました。";
}
//call
system("../judge_server/JUDGE $code_session $code_path ".$_POST["language"]." $testcase_dir_path $point > ".$code_dir.$code_session.".result 2> ".$code_dir.$code_session.".error");
header("Location: https://www.kakecoder.com/result.php");
exit();
?>


</html>
