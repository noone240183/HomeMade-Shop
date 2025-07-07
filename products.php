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
    'price' => 'Price',
    'order_btn' => 'Order',
    'total' => 'Total',
    'candle' => 'Handmade Candle',
    'doll' => 'Handmade Doll',
    'design' => 'Handmade Design',
    'jam' => 'Homemade Jam',
    'picture' => 'Handmade Picture',
    'desc_candle' => 'Soft scent: 150 yen',
    'desc_doll' => 'Huggable: 200 yen',
    'desc_design' => 'Unique: 300 yen',
    'desc_jam' => 'Natural taste: 250 yen',
    'desc_picture' => 'Beautiful work: 350 yen'
  ],
  'ja' => [
    'home' => 'ホーム',
    'products' => '商品',
    'order' => '注文',
    'contact' => 'お問い合わせ',
    'logout' => 'ログアウト',
    'price' => '価格',
    'order_btn' => '注文',
    'total' => '合計',
    'candle' => 'Handmade Candle',
    'doll' => 'Handmade Doll',
    'design' => 'Handmade Design',
    'jam' => 'Homemade Jam',
    'picture' => 'Handmade Picture',
    'desc_candle' => '柔らかな香り：150円',
    'desc_doll' => '抱きしめたくなる：200円',
    'desc_design' => 'ユニーク：300円',
    'desc_jam' => '自然な味：250円',
    'desc_picture' => '美しい作品：350円'
  ]
];
// --- Language switch block END ---
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8">
  <title><?php echo $labels[$lang]['products']; ?> / 商品一覧</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <style>
    * { box-sizing: border-box; font-family: 'Arial', sans-serif; }

    body { background: #fffefb; margin: 0; padding: 0; color: #333; }

    header {
      background: #ffa94d;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .logo { font-size: 1.3em; color: #fff; }

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

    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: white;
      font-weight: bold;
      transition: color 0.2s;
    }

    nav a:hover { color: #333; }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      padding: 40px;
    }

    .product-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.1);
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .product-card:hover { transform: translateY(-5px); }

    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .product-card h3 { font-size: 18px; margin: 10px 0 4px; }

    .product-card p {
      font-size: 14px;
      color: #555;
      padding-bottom: 16px;
    }

    .order-btn {
      background: #ffa94d;
      color: #fff;
      border: none;
      padding: 8px 22px;
      border-radius: 8px;
      font-size: 15px;
      font-weight: bold;
      cursor: pointer;
      margin-bottom: 16px;
      transition: background 0.2s;
    }
    .order-btn:hover {
      background: #ff922b;
    }

    .modal {
      display: none;
      position: fixed;
      z-index: 1000;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      justify-content: center;
      align-items: center;
    }

    .modal img {
      max-width: 90%;
      max-height: 80%;
      border-radius: 10px;
      box-shadow: 0 0 20px #fff;
    }

    .footer {
      text-align: center;
      background: #ffa94d;
      color: white;
      padding: 20px;
      font-size: 14px;
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

  <section class="product-grid">
    <div class="product-card">
      <img src="images/candle.png" alt="Candle">
      <h3><?php echo $labels[$lang]['candle']; ?></h3>
      <p><?php echo $labels[$lang]['desc_candle']; ?></p>
      <button class="order-btn" data-price="150"><?php echo $labels[$lang]['order_btn']; ?></button>
    </div>

    <div class="product-card">
      <img src="images/doll.png" alt="Doll">
      <h3><?php echo $labels[$lang]['doll']; ?></h3>
      <p><?php echo $labels[$lang]['desc_doll']; ?></p>
      <button class="order-btn" data-price="200"><?php echo $labels[$lang]['order_btn']; ?></button>
    </div>

    <div class="product-card">
      <img src="images/design.png" alt="Design">
      <h3><?php echo $labels[$lang]['design']; ?></h3>
      <p><?php echo $labels[$lang]['desc_design']; ?></p>
      <button class="order-btn" data-price="300"><?php echo $labels[$lang]['order_btn']; ?></button>
    </div>

    <div class="product-card">
      <img src="images/jam.png" alt="Jam">
      <h3><?php echo $labels[$lang]['jam']; ?></h3>
      <p><?php echo $labels[$lang]['desc_jam']; ?></p>
      <button class="order-btn" data-price="250"><?php echo $labels[$lang]['order_btn']; ?></button>
    </div>

    <div class="product-card">
      <img src="images/picture.jpeg" alt="Picture">
      <h3><?php echo $labels[$lang]['picture']; ?></h3>
      <p><?php echo $labels[$lang]['desc_picture']; ?></p>
      <button class="order-btn" data-price="350"><?php echo $labels[$lang]['order_btn']; ?></button>
    </div>
  </section>

  <!-- 合計金額表示エリア -->
  <div id="total-amount" style="font-size:1.2em; margin:20px 0; text-align:center;">
    <?php echo $labels[$lang]['total']; ?>: 0円
  </div>

  <!-- Zoom Modal -->
  <div class="modal" id="imageModal">
    <img id="modalImage" src="">
  </div>

  <footer class="footer">
    © 2025 HomeMade Shop | 手作りショップ | Contact: 9800000000 / お問い合わせ
  </footer>

  <script>
    // Image Zoom Modal
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    const productImages = document.querySelectorAll('.product-card img');

    productImages.forEach(img => {
      img.addEventListener('click', () => {
        modal.style.display = 'flex';
        modalImg.src = img.src;
      });
    });

    modal.addEventListener('click', () => {
      modal.style.display = 'none';
    });

    // 注文処理 + localStorage 保存
    const orderButtons = document.querySelectorAll('.order-btn');
    const totalAmountDisplay = document.getElementById('total-amount');
    let totalAmount = 0;

    orderButtons.forEach(button => {
      button.addEventListener('click', () => {
        const card = button.closest('.product-card');
        const name = card.querySelector('h3').textContent;
        const image = card.querySelector('img').src;
        const price = parseInt(button.getAttribute('data-price'));

        const item = { name, image, price };

        let orders = JSON.parse(localStorage.getItem('orders')) || [];
        orders.push(item);
        localStorage.setItem('orders', JSON.stringify(orders));

        totalAmount += price;
        totalAmountDisplay.textContent = "<?php echo $labels[$lang]['total']; ?>: " + totalAmount + "円";
      });
    });
  </script>

</body>
</html>