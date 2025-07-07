<?php
require_once '../db.php'; // データベース接続設定を読み込み

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login/');
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    header('Location: ./');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // ログイン成功
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: ../');  // トップページへ
        exit;
    } else {
        // ログイン失敗
        header('Location: ./');
        exit;
    }
} catch (PDOException $e) {
    // DB接続やクエリ失敗時もリダイレクト
    header('Location: ./');
    exit;
}
