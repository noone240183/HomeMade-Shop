<?php
require_once 'db.php'; // DB接続

// JSON body पढ्ने
$data = json_decode(file_get_contents("php://input"), true);

// error checking
if (!$data || !isset($data['orders'])) {
  http_response_code(400);
  echo "データが無効です。";
  exit;
}

foreach ($data['orders'] as $order) {
  $name = $order['name'];
  $price = $order['price'];
  $image = $order['image'];

  $stmt = $pdo->prepare("INSERT INTO orders (name, price, image) VALUES (?, ?, ?)");
  $stmt->execute([$name, $price, $image]);
}

echo "注文が保存されました。";
// submit_order.php

header('Content-Type: application/json');
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['orders']) || !is_array($data['orders'])) {
    echo json_encode(['status' => 'error', 'message' => '注文データがありません']);
    exit;
}

$orders = $data['orders'];
$user = "customer1"; // ここはログインユーザーIDに置き換えてください

$file = 'orders.json';

if (file_exists($file)) {
    $existing_orders = json_decode(file_get_contents($file), true);
    if (!$existing_orders) $existing_orders = [];
} else {
    $existing_orders = [];
}

if (!isset($existing_orders[$user])) {
    $existing_orders[$user] = [];
}

$existing_orders[$user][] = [
    'orders' => $orders,
    'timestamp' => date('Y-m-d H:i:s')
];

if (file_put_contents($file, json_encode($existing_orders, JSON_PRETTY_PRINT))) {
    echo json_encode(['status' => 'success', 'message' => '注文を保存しました']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'ファイルの保存に失敗しました']);
}
?>
