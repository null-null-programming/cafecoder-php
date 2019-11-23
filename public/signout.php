<?php
$_SESSION = array();
// セッションクッキーを削除
setcookie("PHPSESSID", '', time() - 1800, '/');
session_destroy();
echo "サインアウトしました。";
exit();
?>
