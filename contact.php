<?php
// --- Language switch block START ---
session_start();
if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'ja';

$labels = [
  'en' => [
    'home' => 'Home',
    'products' => 'Products',
    'order' => 'Order',
    'contact' => 'Contact',
    'logout' => 'Logout',
    'contact_us' => 'Contact Us',
    'name' => 'Name',
    'email' => 'Email',
    'message' => 'Message',
    'send' => 'Send'
  ],
  'ja' => [
    'home' => 'ホーム',
    'products' => '商品',
    'order' => '注文',
    'contact' => 'お問い合わせ',
    'logout' => 'ログアウト',
    'contact_us' => 'お問い合わせ',
    'name' => 'お名前',
    'email' => 'メールアドレス',
    'message' => 'メッセージ',
    'send' => '送信'
  ]
];
// --- Language switch block END ---
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $labels[$lang]['contact']; ?> | HomeMade Shop</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Font Awesome for icons -->
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

  <main class="container">
    <h1><?php echo $labels[$lang]['contact_us']; ?></h1>

    <div class="social-links">
      <a class="social-link" href="https://www.instagram.com/" target="_blank">
        <i class="fab fa-instagram"></i> Instagram
      </a>

      <a class="social-link" href="https://lin.ee/your_line_id" target="_blank">
        <i class="fab fa-line"></i> LINE
      </a>
    </div>

    <form class="contact-form" action="#" method="post">
      <label for="name"><?php echo $labels[$lang]['name']; ?></label>
      <input type="text" id="name" name="name" required>

      <label for="email"><?php echo $labels[$lang]['email']; ?></label>
      <input type="email" id="email" name="email" required>

      <label for="message"><?php echo $labels[$lang]['message']; ?></label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit"><?php echo $labels[$lang]['send']; ?></button>
    </form>
  </main>

  <footer class="footer">
    © 2025 HomeMade Shop | Contact: 9800000000 | handmade@shop.com
  </footer>