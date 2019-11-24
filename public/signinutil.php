<?php
session_start();

include_once("../database/connection.php");
/*
 * do not pass $_SESSION["username"]
* @param string $username
* @return bool issignin
*/
function is_signin($username){
    return $_SESSION["username"] === $username;
}

/*
 * @param string $username
 * @param string $password
 * @return bool issignin
 * */

function signin($username, $password){
    //password is safe because it is hashed with sha256 
    if(!preg_match("/^[a-zA-Z0-9_]+$/", $username)){
        echo "ユーザー名に使用できない文字が含まれています。";
        return false;
    }

    if($username == null || $password == null){
        return false;
    }
    $con = new DBC();
    try{
    $rec = $con->prepare_execute("SELECT uid,username,role FROM users WHERE username=? and password_hash=? ", array($username, $con->sha256hash($password)))[0];
    }catch(Exception $e){
        var_dump($e);
        echo "DB SELECT ERROR";
    }
    if($rec["uid"] != null){
        session_start();
        $_SESSION["uid"] = $rec["uid"];
        $_SESSION["username"] = $rec["username"];
        $_SESSION["role"] = $rec["role"];
        return true;
    }else{
        return false;
    }
}

if(isset($_POST["username"]) && isset($_POST["password"])){
    if(signin($_POST["username"], $_POST["password"])){
        header("Location: /users/".$_POST["username"]);
        exit();
    }else{
        echo "ユーザー名かパスワードが正しくありません。";
        exit();
    }
}
?>
