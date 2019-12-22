<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>提出</title>
</head>

<body>
    
<?php
ini_set('display_errors', "On");
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
$code = base64_encode($_POST["sourcecode"]);
$username = $_SESSION["username"];
$auth_token = $_SESSION["token"];
$problem = $problem[$_POST["problem"]];
$language = $_POST["language"];
$contest_id = $_POST["contest_id"];
include_once "./call_api.php";
//point and testcase_dir
/*
sesssion to mysql 
*/
$res = call_api("code","POST",array('code'=>$code,'username'=>$username,'language'=>$language,'auth_token'=>$auth_token,'problem'=>$problem,'contest_id'=>$contest_id));
$_SESSION["code_session"] = $res["code_session"];
header("Location: /result.php?username=".$_SESSION["username"]."&code_session=".$res["code_session"]."&contest_id=$contest_id");
exit();
?>


</html>
