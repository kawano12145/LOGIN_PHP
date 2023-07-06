<?php

$host = 'localhost';
$dbname = 'login';
$username = 'admin';
$password = '07132722';


$db = new mysqli($host, $username, $password, $dbname);
if ($db->connect_error) {
    die("データベースへの接続に失敗しました: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // フォームからのデータを取得
  $gender = $_POST["gender"];
  $blood = $_POST["blood"];
  $opinion = $_POST["opinion"];

  // SQLクエリの作成と実行
  $sql = "INSERT INTO  users(gender, blood, opinion) VALUES ('$gender', '$blood', '$opinion')";
  if ($db->query($sql) === TRUE) {
      echo "送信完了しました。";
  } else {
      echo "上手く送信できませんでした。: " . $sql . "<br>" . $db->error;
  }
}
?>