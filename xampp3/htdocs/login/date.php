



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
  <div class="message">
    送信完了しました。
  </div>
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