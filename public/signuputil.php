<?php
try{
include_once("./call_api.php");
}catch(Exception $e){
    echo "DB INIT ERROR";
    exit();
}

/*
 * @param string $username
 * @param string $password
 * @return bool result
 * @todo email
 * */
function signup($username, $password, $email, $role){
    if(!preg_match("/^[a-zA-Z0-9_]+$/",$username)){
        echo "現在ユーザー名に使用出来る文字列はa-zA-Z0-9です。";
        return false;
    }

    if($username == null || $password == null){
        return false;
    }
    if(strlen($username) > 30){
        echo "ユーザー名が長すぎます。";
        return false;
    }

    //is there username
    try{
        $res = call_api("user","GET",array('username'=>$username));
    }catch(Exception $e){
        echo "DB SELECT ERROR";
        exit();
    }
    if ($res["result"]){
        echo "すでに同名のユーザーがいます。";
        return false; 
    }
    //insert
    try{
        $res = call_api("user","POST",array('username'=>$username,'password'=>$password));
    }catch(Exception $e){
        echo "エラーが発生しました。";
        return false;
    }
    return $res["result"];
}

    if(isset($_POST["username"]) && isset($_POST["password"])){
	$username = htmlspecialchars($_POST["username"], ENT_QUOTES);
        if(signup($username, $_POST["password"], "", "user")){
	    mkdir("./users/".$username, true);
        chmod("./users/".$usrename, 0777);
	    copy("../template/userpage/template.php","users/".$username."/index.php");
        echo "登録が完了しました。<br /><a href=\"signin.php\">サインイン</a>";
        }
    }
?>
