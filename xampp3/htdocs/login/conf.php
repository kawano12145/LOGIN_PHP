

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
