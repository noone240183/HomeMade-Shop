<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>Products / 商品一覧</title>
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

    nav a {
      margin-left: 20px;
      text-decoration: none;
      color: white;
      font-weight: bold;
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
      <a href="order.php">About Us / 私たちについて</a>
      <a href="contact.php">Contact / お問い合わせ</a>
    </nav>
  </header>

  <section class="product-grid">
    <div class="product-card">
      <img src="images/candle.png" alt="Candle">
      <h3>Handmade Candle</h3>
      <p>円.150 / 柔らかな香り：150円</p>
      <button class="order-btn" data-price="150">注文</button>
    </div>

    <div class="product-card">
      <img src="images/doll.png" alt="Doll">
      <h3>Handmade Doll</h3>
      <p>円.200 / 抱きしめたくなる：200円</p>
      <button class="order-btn" data-price="200">注文</button>
    </div>

    <div class="product-card">
      <img src="images/design.png" alt="Design">
      <h3>Handmade Design</h3>
      <p>円.300 / ユニーク：300円</p>
      <button class="order-btn" data-price="300">注文</button>
    </div>

    <div class="product-card">
      <img src="images/jam.png" alt="Jam">
      <h3>Homemade Jam</h3>
      <p>円.250 / 自然な味：250円</p>
      <button class="order-btn" data-price="250">注文</button>
    </div>

    <div class="product-card">
      <img src="images/picture.jpeg" alt="Picture">
      <h3>Handmade Picture</h3>
      <p>円.350 / 美しい作品：350円</p>
      <button class="order-btn" data-price="350">注文</button>
    </div>
  </section>

  <!-- 合計金額表示エリア -->
  <div id="total-amount" style="font-size:1.2em; margin:20px 0; text-align:center;">
    合計: 0円
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
        totalAmountDisplay.textContent = `合計: ${totalAmount}円`;
      });
    });
  </script>

</body>
</html>
