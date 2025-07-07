<?php
require_once 'db.php'; // DB接続

// 商品一覧を取得
$sql = "SELECT * FROM products ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>Products / 商品一覧</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    /* --- 省略せず貼ってください（元のCSSと同じ） --- */
    * {
      box-sizing: border-box;
      font-family: 'Arial', sans-serif;
    }

    body {
      background: #fffefb;
      margin: 0;
      padding: 0;
      color: #333;
    }

    header {
      background: #ffa94d;
      padding: 15px 30px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: white;
      font-weight: bold;
    }

    nav a:hover {
      color: #333;
    }

    .product-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 30px;
      padding: 40px;
    }

    .product-card {
      background: #fff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease;
    }

    .product-card:hover {
      transform: translateY(-5px);
    }

    .product-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      cursor: pointer;
      transition: transform 0.3s ease;
    }

    .product-card h3 {
      font-size: 18px;
      margin: 10px 0 4px;
    }

    .product-card p {
      font-size: 14px;
      color: #555;
      padding-bottom: 16px;
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
    <nav>
      <a href="index.php">Home / ホーム</a>
      <a href="products.php">Products / 商品</a>
      <a href="order.php">Order / 注文</a>
      <a href="contact.php">Contact / お問い合わせ</a>
      <a href="logout.php" class="logout">Logout / ログアウト</a>
    </nav>
  </header>

  <section class="product-grid">
    <?php foreach ($products as $product): ?>
      <div class="product-card">
        <img src="images/uploads/<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
        <h3><?= htmlspecialchars($product['name']) ?></h3>
        <p><?= htmlspecialchars($product['name_jp']) ?>：<?= number_format($product['price']) ?>円</p>
        <button class="order-btn" data-price="<?= $product['price'] ?>">注文</button>
      </div>
    <?php endforeach; ?>
  </section>

  <div id="total-amount" style="font-size:1.2em; margin:20px 0; text-align:center;">
    合計: 0円
  </div>

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

        const item = {
          name,
          image,
          price
        };

        let orders = JSON.parse(localStorage.getItem('orders')) || [];
        orders.push(item);
        localStorage.setItem('orders', JSON.stringify(orders));

        totalAmount += price;
        totalAmountDisplay.textContent = `合計: ${totalAmount}円`;
      });
    });
  </script>

</body>

</html>