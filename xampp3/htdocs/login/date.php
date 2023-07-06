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
  $gender = isset($_POST["gender"]) ? $_POST["gender"] : '';
  $blood = isset($_POST["blood"]) ? $_POST["blood"] : '';
  $opinion = isset($_POST["opinion"]) ? $_POST["opinion"] : '';

  // SQLクエリの作成と実行
  $sql = "INSERT INTO  form1(gender, blood, opinion) VALUES ('$gender', '$blood', '$opinion')";
  if ($db->query($sql) === TRUE) {
      echo '<p class="message">送信完了しました。</p>';

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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="date.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

</head>

<body>
<div class="button-container">
      <form action="home.php">
        <input type="submit" value="HOME画面へ" />
      </form>
      <br />
      <form action="logout.php" method="post">
        <input type="hidden" name="redirect" value="login.php" />
        <input type="submit" value="ログアウト" />
      </form>
      
    </div>
  
</body>
</html>