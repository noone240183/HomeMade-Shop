<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>お会計 / 注文リスト</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      font-family: 'Arial', sans-serif;
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

    nav a:hover { color: #333; }

    .container {
      padding: 40px;
    }

    h2 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .order-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      border-bottom: 1px solid #ccc;
      padding: 15px 0;
    }

    .order-item-left {
      display: flex;
      align-items: center;
    }

    .order-item img {
      width: 100px;
      height: 100px;
      object-fit: cover;
      border-radius: 10px;
      margin-right: 20px;
    }

    .order-info h3 {
      margin: 0;
      font-size: 18px;
    }

    .order-info p {
      margin: 4px 0 0;
      font-size: 14px;
      color: #555;
    }

    .remove-btn {
      background: red;
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 8px;
      cursor: pointer;
      font-size: 14px;
    }

    .remove-btn:hover {
      background: darkred;
    }

    .total {
      font-size: 20px;
      font-weight: bold;
      text-align: center;
      margin-top: 30px;
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
    </nav>
  </header>

  <div class="container">
    <h2>🧾 ご注文リスト</h2>
    <div id="order-list"></div>
    <div class="total" id="total-amount">合計: 0円</div>
  </div>
  <div style="margin-top: 40px;">
  <h3>💳 ご利用可能なお支払い方法</h3>
  <ul style="list-style: none; padding: 0; display: flex; flex-wrap: wrap; gap: 20px;">
    <li><img src="images/visa.png" alt="VISA" style="width: 50px;"></li>
    <li><img src="images/mastercard.png" alt="MasterCard" style="width: 50px;"></li>
    <li><img src="images/paypal.png" alt="PayPal" style="width: 50px;"></li>
    <li><img src="images/conbini.png" alt="Konbini" style="width: 50px;"></li>
    <li><img src="images/cash.png" alt="LINE Pay" style="width: 50px;"></li>  
  </ul>
  </div>


  <footer class="footer">
    © 2025 HomeMade Shop | 手作りショップ | Contact: 9800000000
  </footer>

  <script>
    const orderList = document.getElementById('order-list');
    const totalAmountDisplay = document.getElementById('total-amount');

    let orders = JSON.parse(localStorage.getItem('orders')) || [];

    function renderOrders() {
      orderList.innerHTML = '';
      let total = 0;

      if (orders.length === 0) {
        orderList.innerHTML = "<p>まだ注文はありません。</p>";
        totalAmountDisplay.textContent = `合計: 0円`;
        return;
      }

      orders.forEach((order, index) => {
        total += order.price;

        const item = document.createElement('div');
        item.className = 'order-item';
        item.innerHTML = `
          <div class="order-item-left">
            <img src="${order.image}" alt="${order.name}">
            <div class="order-info">
              <h3>${order.name}</h3>
              <p>価格: ${order.price}円</p>
            </div>
          </div>
          <button class="remove-btn" onclick="removeOrder(${index})">削除 ✖</button>
        `;
        orderList.appendChild(item);
      });

      totalAmountDisplay.textContent = `合計: ${total}円`;
    }

    function removeOrder(index) {
      orders.splice(index, 1);
      localStorage.setItem('orders', JSON.stringify(orders));
      renderOrders();
    }

    renderOrders();
  </script>

</body>
</html>
