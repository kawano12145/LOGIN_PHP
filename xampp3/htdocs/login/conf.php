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
    $sql = "INSERT INTO users (gender, blood, opinion) VALUES ('$gender', '$blood', '$opinion')";
    if ($db->query($sql) === TRUE) {
        echo "送信完了しました。";
    } else {
        echo "上手く送信できませんでした。: " . $sql . "<br>" . $db->error;
    }
}
?>


<?php

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}


?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="conf.css" />
    <title></title>
    <h1>入力内容確認</h1>
    
   
<div class="timezone">
<?php
date_default_timezone_set('Asia/Tokyo');
echo date("Y年m月d日 H:i:s");

?>
</div>
  </head>
  <div class="form">
  <body>
    <p>性別：<?= $_POST["gender"]?></p>
    <p>血液型：<?= $_POST["blood"]?></p>
    <p>ご意見：<?= $_POST["opinion"]?></p>
    <br />
    <form action="date.php" method="post">
      <input type="submit" value="送信" />
    </form>
  </div>
  <br />
  <div class="button-container">

    <form action="index.php">
      <input type="submit" value="修正する" />
    </form>
  </div>

    
  </body>
</html>
