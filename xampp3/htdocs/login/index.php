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
    <link rel="stylesheet" href="index.css" />
    <title>アンケート</title>
    <h1>アンケート</h1>
    
<div class="timezone">
<?php
date_default_timezone_set('Asia/Tokyo');
echo date("Y年m月d日 H:i:s");

?>
</div>
  </head>
  <body>
    <div class="form">
      <form action="post.php" method="post">
   
        <p>
          性別： <input type="radio" name="gender" value="男性" />男性
          <input type="radio" name="gender" value="女性" />女性
        </p>
        <p>
          血液型：
          <select name="blood">
            <option value="A">A</option>
            <option value="B">B</option>
            <option value="O">O</option>
            <option value="AB">AB</option>
          </select>
        </p>
        <p>ご意見：</p>
        <p><textarea name="opinion" cols="42" rows="5"></textarea></p>
        <p><input type="submit" name="submitBtn" value="送信" /></p>
      </form>
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
    <br />
  </body>
</html>
