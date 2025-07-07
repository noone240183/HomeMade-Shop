<?php
$host = 'localhost';
$dbname = 'home_made_shop';
$username = 'root';
$password = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 🔍 ユーザー名重複チェック
        $check = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ?");
        $check->execute([$user]);

        if ($check->fetchColumn() > 0) {
            $message = '❌ そのユーザー名はすでに使われています。';
        } else {
            // ✅ 新規登録
            $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->execute([$user, $hash]);
            $message = '✅ 登録が完了しました。<a href="login.php">ログイン</a>';
        }

    } catch (PDOException $e) {
        $message = '登録エラー: ' . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ユーザー登録</title>
    <style>
        body {
            background: rgb(223, 192, 178);
            font-family: 'Segoe UI', Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
            padding-top: 40px;
        }
        .register-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.13);
            width: 400px;
            padding: 40px 32px 32px 32px;
            text-align: center;
        }
        .register-container h1 {
            margin-bottom: 32px;
            color: #28a745;
            font-size: 2.2rem;
            letter-spacing: 2px;
        }
        .register-container input[type="text"],
        .register-container input[type="password"] {
            width: 96%;
            padding: 20px;
            margin-bottom: 24px;
            border: 1.5px solid #bbb;
            border-radius: 8px;
            font-size: 1.5rem;
            background: rgb(232, 224, 224);
            transition: border 0.2s;
        }
        .register-container input[type="text"]:focus,
        .register-container input[type="password"]:focus {
            border: 2px solid #28a745;
            outline: none;
            background: rgb(233, 246, 239);
        }
        .register-container button {
            width: 100%;
            padding: 18px;
            background: linear-gradient(90deg, #28a745 60%, #218838 100%);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 1.4rem;
            font-weight: bold;
            cursor: pointer;
            margin-bottom: 18px;
            transition: background 0.2s;
        }
        .register-container button:hover {
            background: linear-gradient(90deg, #218838 60%, #28a745 100%);
        }
        .register-container .message {
            margin: 10px 0 15px 0;
            color: #d00;
            font-size: 1.1rem;
        }
        .register-container a {
            color: #007bff;
            text-decoration: none;
            font-size: 1.1rem;
            display: block;
            margin-top: 0;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>ユーザー登録</h1>
        <form method="post">
            <input type="text" name="username" placeholder="ユーザー名" required><br>
            <input type="password" name="password" placeholder="パスワード" required><br>
            <button type="submit">登録</button>
        </form>
        <div class="message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div>
        <a href="login.php">ログイン画面へ戻る</a>
    </div>
</body>
</html>
