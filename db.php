<?php
require_once 'env.php';

$db_host = DB_HOST;
$db_user = DB_USER;
$db_password = DB_PASSWORD;
$db_name = DB_NAME;

// データベース接続設定
$dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8";

try {
    $pdo = new PDO($dsn, $db_user, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    exit('DB接続エラー: ' . $e->getMessage());
}
