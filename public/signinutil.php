<?php
session_start();
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
    
    ini_set('display_errors', "On");
    //password is safe because it is hashed with sha256 
    if(!preg_match("/^[a-zA-Z0-9_]+$/", $username)){
        echo "ユーザー名に使用できない文字が含まれています。";
        return false;
    }

    if($username == null || $password == null){
        return false;
    }
    //$con = new DBC();
    try{
    include_once("./call_api.php");
    $q = array('username'=>$username, 'password'=>$password);
    $response = call_api("auth", "POST", $q);
    session_start();
    return $response;
    //$rec = $con->prepare_execute("SELECT uid,username,role FROM users WHERE username=? and password_hash=? ", array($username, $con->sha256hash($password)))[0];
    }catch(Exception $e){
        var_dump($e);
        echo "DB SELECT ERROR";
    }
}
if(isset($_POST["username"]) && isset($_POST["password"])){
    $response = signin($_POST["username"], $_POST["password"]);
    if($response["result"]){
	session_start();
        $_SESSION["token"] = $response["auth_token"];
        $_SESSION["username"] = $_POST["username"];
        header("Location: /users/".$_POST["username"]);
        exit();
    }else{
        echo "ユーザー名かパスワードが正しくありません。";
        exit();
    }
}
?>
