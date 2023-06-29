<?php
session_start();

// セッション変数を破棄します
$_SESSION = array();

// セッションを完全に破棄します
session_destroy();

// リダイレクト先の取得
$redirect = isset($_POST['redirect']) ? $_POST['redirect'] : 'login.php';

// リダイレクト
header("Location: $redirect");
exit;


?>

