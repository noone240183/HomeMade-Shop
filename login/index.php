<?php
session_start();
$host = 'localhost';
$dbname = 'home_made_shop';
$username = 'root';
$password = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$user]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($pass, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            header('Location: index.php');
            exit;
        } else {
            $message = 'ユーザー名またはパスワードが違います';
        }
    } catch (PDOException $e) {
        $message = 'ログインエラー: ' . htmlspecialchars($e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
    }

    /* Background Video Styling */
    #bg-video {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      z-index: -1;
    }

    .login-container {
      position: relative;
      z-index: 1;
      max-width: 400px;
      margin: 100px auto;
      background: rgba(255, 255, 255, 0.92);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.2);
      text-align: center;
    }

    .login-container h1 {
      color: #007bff;
      margin-bottom: 30px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
    }

    .login-container button {
      width: 100%;
      padding: 15px;
      background: linear-gradient(to right, #007bff, #0056b3);
      color: #fff;
      font-size: 16px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
    }

    .login-container .message {
      color: red;
      margin-top: 15px;
    }

    .login-container a {
      display: block;
      margin-top: 10px;
      color: #007bff;
      text-decoration: none;
    }

    .login-container a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <!-- Video Background -->
  <video autoplay muted loop id="bg-video">
    <source src="video/video.mp4" type="video/mp4">
    お使いのブラウザは video タグをサポートしていません。
  </video>

  <div class="login-container">
    <h1>ログイン</h1>
    <form method="post" action="login.php">
      <input type="text" name="username" placeholder="ユーザー名" required>
      <input type="password" name="password" placeholder="パスワード" required>
      <button type="submit">ログイン</button>
    </form>
    <a href="register.php">新規登録はこちら</a>
    <div class="message"><?php echo $message; ?></div>
  </div>

</body>
</html>
