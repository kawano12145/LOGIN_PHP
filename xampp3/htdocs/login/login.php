<?php
// データベースの接続情報
$host = 'localhost';
$dbname = 'login';
$username = 'admin';
$password = '07132722';
$error = '';
try {


    // データベースに接続
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // ログインフォームが送信された場合の処理
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ユーザーが入力した情報を取得
        $username = $_POST['username'] ?? '';
        $inputPassword = $_POST['password'] ?? '';

        // 入力値のチェック
    if (empty($username) || empty($inputPassword)) {
      $error = '<span style="color: red;">
      ユーザー名またはパスワードが間違っています。</span>';
      
    
      
  }
 

        // データベースでユーザーを検索
        $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$username]);
        $user = $stmt->fetch();

       
        
        // パスワードの照合
        if ($user && password_verify($inputPassword, $user['password'])) {
          //↑　ユーザーが存在しない場合にfalseを返さないように
            // ログイン成功時の処理
            // セッションなどの操作を行う

            //セッション ID の伝達方法を制御
            session_start();
         
      
            $_SESSION['username'] = $username;
            // ログイン後のリダイレクトなど
            header('Location: home.php');
            exit;
        } else {
            // ログイン失敗時の処理
            
            $error = '<span style="color: red;">
            ユーザー名またはパスワードが間違っています。</span>';
          
        }
    }
} catch (PDOException $e) {
    // データベース接続エラー時の処理
    $error = 'データベースに接続できませんでした。';
    // エラーメッセージの表示など

}


?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="login.css" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ログイン</title>
</head>
<header>
  <h1>
  ログイン
</h1>

<div class="timezone">
<?php
date_default_timezone_set('Asia/Tokyo');
echo date("Y年m月d日 H:i:s");

?>
</div>

<br />
</header>

<body>
<div class="login">
    <form action="" method="POST">
     

    
        <label for="login-mail"
        ><span>メールアドレス</span>

          
             <input id="username" name="username" type="email" placeholder="メールアドレスを入力"/><br />
      </label>
        

        <label for="login-pass"
        ><span>パスワード</span>
        <input type="password" id="password" name="password" placeholder="パスワードを入力"/><br />
      </label>
      <br />
        <form action="login.php">
        <button name="login" type="submit">ログイン</button>
        </form>

    </form>
        
    
<br />
    
        <form action="register.php">
          <button name="register" type="submit">新規登録</button>
        </form>
</div>

<br />
<br />




</body>

<div class="error">
<?php echo $error; ?></div>
</html>