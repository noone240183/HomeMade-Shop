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
