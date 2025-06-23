<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact / お問い合わせ</title>
  <link rel="stylesheet" href="style.css">
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> <!-- Font Awesome for icons -->
</head>
<body>

  <header>
    <div class="logo"><strong>HomeMade Shop | 手作りショップ</strong></div>
    <nav>
     <a href="index.php">Home / ホーム</a>
      <a href="products.php">Products / 商品</a>
      <a href="order.php">About Us / 私たちについて</a>
      <a href="contact.php">Contact / お問い合わせ</a>
    </nav>
  </header>

  <main class="container">
    <h1>Contact Us / お問い合わせ</h1>

    <div class="social-links">
      <a class="social-link" href="https://www.instagram.com/" target="_blank">
        <i class="fab fa-instagram"></i> Instagram
      </a>

      <a class="social-link" href="https://lin.ee/your_line_id" target="_blank">
        <i class="fab fa-line"></i> LINE
      </a>
    </div>

    <form class="contact-form" action="#" method="post">
      <label for="name">Name / お名前</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Email / メールアドレス</label>
      <input type="email" id="email" name="email" required>

      <label for="message">Message / メッセージ</label>
      <textarea id="message" name="message" rows="5" required></textarea>

      <button type="submit">Send / 送信</button>
    </form>
  </main>

  <footer class="footer">
    © 2025 HomeMade Shop | Contact: 9800000000 | handmade@shop.com
  </footer>

</body>
</html>
