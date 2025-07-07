<?php
require_once 'db.php'; // データベース接続設定を読み込み

session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: login/");
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>HomeMade Shop | 手作りショップ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

  <header>
    <div class="logo"><strong>HomeMade Shop | 手作りショップ</strong></div>
    <nav>
      <a href="index.php">Home / ホーム</a>
      <a href="products.php">Products / 商品</a>
      <a href="order.php">Order / 注文</a>
      <a href="contact.php">Contact / お問い合わせ</a>
      <a href="logout.php" class="logout">Logout / ログアウト</a>
    </nav>
  </header>

  <section class="hero">
    <img src="images/hp3.png" alt="Handmade Product" style="width: 250px; height: auto;">
    <div>
      <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?> さん！</h1>
      <p>Natural and local handmade goods, crafted with love.<br>自然で心を込めて作られた家庭の手作り商品をご覧ください。</p>
    </div>
  </section>

  <section class="products">
    <div class="product-track">
      <!-- 画像スライドショー -->
      <div class="product-slide"><img src="images/hp1.png" alt="1"></div>
      <div class="product-slide"><img src="images/hp2.png" alt="2"></div>
      <div class="product-slide"><img src="images/hp3.png" alt="3"></div>
      <div class="product-slide"><img src="images/hp4.png" alt="4"></div>
      <div class="product-slide"><img src="images/hp5.png" alt="5"></div>
      <div class="product-slide"><img src="images/hp1.png" alt="1"></div>
      <div class="product-slide"><img src="images/hp2.png" alt="2"></div>
      <div class="product-slide"><img src="images/hp3.png" alt="3"></div>
      <div class="product-slide"><img src="images/hp4.png" alt="4"></div>
      <div class="product-slide"><img src="images/hp5.png" alt="5"></div>
    </div>
  </section>

  <footer class="footer">
    © 2025 HomeMade Shop | 手作りショップ | Contact: 9800000000 / お問い合わせ
  </footer>

</body>
</html>
