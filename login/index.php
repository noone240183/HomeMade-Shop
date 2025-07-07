<?php
require_once '../db.php'; // データベース接続設定を読み込み

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    try {
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
        body {
            background:rgb(223, 192, 178);
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding-top: 40px;
        }
        .login-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.13);
            width: 400px;
            padding: 40px 32px 32px 32px;
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 32px;
            color: #007bff;
            font-size: 2.2rem;
            letter-spacing: 2px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 96%;
            padding: 20px;
            margin-bottom: 24px;
            border: 1.5px solid #bbb;
            border-radius: 8px;
            font-size: 1.5rem;
            background:rgb(232, 224, 224);
            transition: border 0.2s;
        }
        .login-container input[type="text"]:focus,
        .login-container input[type="password"]:focus {
            border: 2px solid #007bff;
            outline: none;
            background:rgb(233, 239, 246);
        }
        .login-container button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(90deg, #007bff 60%, #0056b3 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.4rem;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 18px;
            transition: background 0.2s;
        }
        .login-container button:hover {
            background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
        }
        .login-container .message {
            margin: 10px 0 15px 0;
            color: #d00;
            font-size: 1.1rem;
        }
        .login-container a {
            color: #007bff;
            text-decoration: none;
            font-size: 1.1rem;
            display: block;
            margin-top: 0;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>ログイン</h1>
        <form method="post" action="auth.php">
            <input type="text" name="username" placeholder="ユーザー名" required><br>
            <input type="password" name="password" placeholder="パスワード" required><br>
            <button type="submit">ログイン</button>
        </form>
        <a href="../register/">新規登録はこちら</a>
        <div class="message"><?php echo $message; ?></div>
    </div>
</body>
</html>