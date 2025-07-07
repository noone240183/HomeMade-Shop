<?php
require_once 'db.php'; // データベース接続設定を読み込み

session_start();

// --- Language switch block START ---
if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'en';

$labels = [
  'en' => [
    'home' => 'Home',
    'products' => 'Products',
    'order' => 'Order',
    'contact' => 'Contact',
    'logout' => 'Logout'
  ],
  'ja' => [
    'home' => 'ホーム',
    'products' => '商品',
    'order' => '注文',
    'contact' => 'お問い合わせ',
    'logout' => 'ログアウト'
  ]
];
// --- Language switch block END ---

if (!isset($_SESSION['user_id'])) {
  header("Location: login/");
  exit;
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <title>HomeMade Shop | 手作りショップ</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <script src="script.js" defer></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    .lang-btn {
      margin-right: 8px;
      color: #fff;
      background: #339af0;
      padding: 4px 12px;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
      transition: background 0.2s;
    }
    .lang-btn:hover {
      background: #1971c2;
    }
  </style>
</head>
<body>

  <header>
    <div class="logo"><strong>HomeMade Shop | 手作りショップ</strong></div>
    <!-- Language Switch Option -->
    <div style="margin-bottom:10px;">
      <a href="?lang=en" class="lang-btn"<?php if($lang=='en') echo ' style="font-weight:bold;"'; ?>>English</a> |
      <a href="?lang=ja" class="lang-btn"<?php if($lang=='ja') echo ' style="font-weight:bold;"'; ?>>日本語</a>
    </div>
    <nav>
      <a href="index.php"><?php echo $labels[$lang]['home']; ?></a>
      <a href="products.php"><?php echo $labels[$lang]['products']; ?></a>
      <a href="order.php"><?php echo $labels[$lang]['order']; ?></a>
      <a href="contact.php"><?php echo $labels[$lang]['contact']; ?></a>
      <a href="logout.php" class="logout"><?php echo $labels[$lang]['logout']; ?></a>
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