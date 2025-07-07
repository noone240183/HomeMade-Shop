<?php
// cancel_order.php
header("Location: history.php");

$user = $_POST['user'] ?? '';
$order_index = $_POST['order_index'] ?? '';

if ($user === '' || $order_index === '') {
    exit('不正なリクエストです。');
}

$file = 'orders.json';

if (!file_exists($file)) {
    exit('注文データが見つかりません。');
}

$orders_data = json_decode(file_get_contents($file), true);

if (!isset($orders_data[$user][$order_index])) {
    exit('キャンセルする注文が見つかりません。');
}

// 注文セットを削除
array_splice($orders_data[$user], $order_index, 1);

// もしそのユーザーの注文が空になったらユーザー自体も削除
if (empty($orders_data[$user])) {
    unset($orders_data[$user]);
}

// 新しいデータをファイルに書き込む
file_put_contents($file, json_encode($orders_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

// 注文履歴ページにリダイレクト
header("Location: history.php");
exit;
header("Location: /HomeMadeShop/history.php");
exit;
