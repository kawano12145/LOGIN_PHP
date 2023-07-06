<?php

session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="home.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>home</title>
  <header>
    <h1>
    HOME画面</h1>

 
<div class="timezone">
<?php
date_default_timezone_set('Asia/Tokyo');
echo date("Y年m月d日 H:i:s");

?>
</div>


  </header>

</head>

<body>


  <h2><div class="username">
    <?php echo $_SESSION['username']; ?> </div>さん、ようこそ！</h2>



<div class="link">
<a href="index.php">アンケート記入を始める</a>
</div>
<br />

  <form action="logout.php" method="post">
    <input type="hidden" name="redirect" value="login.php"> 
    <input type="submit" value="ログアウト"/>
</form>
  
</body>
</html>