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
    'history' => 'Order History',
    'order_list' => '🧾 Order List',
    'view_orders' => '🛒 View Order List',
    'total' => 'Total',
    'no_orders' => 'No orders yet.',
    'confirm_order' => 'Confirm this order?',
    'checkout' => '✅ Confirm Order',
    'thanks' => 'Thank you for your order! 🍀',
    'fail_save' => 'Failed to save order: ',
    'no_order_alert' => 'No orders.',
    'payment_methods' => '💳 Available Payment Methods',
    'cash' => 'Cash',
    'conbini' => 'Konbini',
    'price' => 'Price'
  ],
  'ja' => [
    'home' => 'ホーム',
    'products' => '商品',
    'order' => '注文',
    'contact' => 'お問い合わせ',
    'logout' => 'ログアウト',
    'history' => '注文履歴',
    'order_list' => '🧾 ご注文リスト',
    'view_orders' => '🛒 注文リストを見る',
    'total' => '合計',
    'no_orders' => 'まだ注文はありません。',
    'confirm_order' => 'この内容で注文を確定しますか？',
    'checkout' => '✅ 注文を確定する',
    'thanks' => 'ご注文ありがとうございました！🍀',
    'fail_save' => '注文の保存に失敗しました: ',
    'no_order_alert' => '注文がありません。',
    'payment_methods' => '💳 ご利用可能なお支払い方法',
    'cash' => '現金',
    'conbini' => 'コンビニ',
    'price' => '価格'
  ]
];
// --- Language switch block END ---
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
  <meta charset="UTF-8" />
  <title><?php echo $labels[$lang]['order_list']; ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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

    .logo {
      font-size: 1.3em;
      color: #fff;
    }

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

    nav a:hover {
      color: #333;
    }

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

    .checkout-section {
      text-align: center;
      margin: 40px 0;
    }

    #checkout-btn {
      background-color: #ffa94d;
      color: white;
      font-size: 18px;
      padding: 12px 30px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
    }

    #checkout-btn:hover {
      background-color: #ff922b;
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
      <a href="history.php"><?php echo $labels[$lang]['history']; ?></a>
      <a href="logout.php" class="logout"><?php echo $labels[$lang]['logout']; ?></a>
    </nav>
  </header>

  <div class="container">
    <h2><?php echo $labels[$lang]['order_list']; ?></h2>

    <!-- 注文リスト表示ボタン -->
    <div style="text-align: center; margin-bottom: 20px;">
      <button onclick="renderOrders()" style="padding: 10px 20px; background: #339af0; color: white; border: none; border-radius: 8px; cursor: pointer;">
        <?php echo $labels[$lang]['view_orders']; ?>
      </button>
    </div>

    <div id="order-list"></div>
    <div class="total" id="total-amount"><?php echo $labels[$lang]['total']; ?>: 0円</div>
  </div>

  <div class="checkout-section">
    <button id="checkout-btn"><?php echo $labels[$lang]['checkout']; ?></button>
  </div>

  <div style="margin-top: 40px;">
    <h3><?php echo $labels[$lang]['payment_methods']; ?></h3>
    <ul style="list-style: none; padding: 0; display: flex; flex-wrap: wrap; gap: 20px;">
      <li style="text-align: center;">
        <img src="images/visa.png" alt="VISA" style="width: 50px;" />
        <div>VISA</div>
      </li>
      <li style="text-align: center;">
        <img src="images/mastercard.png" alt="MasterCard" style="width: 50px;" />
        <div>MasterCard</div>
      </li>
      <li style="text-align: center;">
        <img src="images/paypal.png" alt="PayPal" style="width: 50px;" />
        <div>PayPal</div>
      </li>
      <li style="text-align: center;">
        <img src="images/conbini.png" alt="Konbini" style="width: 50px;" />
        <div><?php echo $labels[$lang]['conbini']; ?></div>
      </li>
      <li style="text-align: center;">
        <img src="images/cash.png" alt="Cash" style="width: 50px;" />
        <div><?php echo $labels[$lang]['cash']; ?></div>
      </li>
    </ul>
  </div>

  <footer class="footer">
    © 2025 HomeMade Shop | 手作りショップ | Contact: 9800000000
  </footer>

  <script>
    const orderList = document.getElementById('order-list');
    const totalAmountDisplay = document.getElementById('total-amount');
    let orders = JSON.parse(localStorage.getItem('orders')) || [];

    // Language labels for JS
    const jsLabels = {
      no_orders: <?php echo json_encode($labels[$lang]['no_orders']); ?>,
      total: <?php echo json_encode($labels[$lang]['total']); ?>,
      price: <?php echo json_encode($labels[$lang]['price']); ?>,
      remove: "削除 ✖",
      confirm_order: <?php echo json_encode($labels[$lang]['confirm_order']); ?>,
      thanks: <?php echo json_encode($labels[$lang]['thanks']); ?>,
      fail_save: <?php echo json_encode($labels[$lang]['fail_save']); ?>,
      no_order_alert: <?php echo json_encode($labels[$lang]['no_order_alert']); ?>
    };

    function renderOrders() {
      orderList.innerHTML = '';
      let total = 0;

      if (orders.length === 0) {
        orderList.innerHTML = `<p>${jsLabels.no_orders}</p>`;
        totalAmountDisplay.textContent = `${jsLabels.total}: 0円`;
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
              <p>${jsLabels.price}: ${order.price}円</p>
            </div>
          </div>
          <button class="remove-btn" onclick="removeOrder(${index})">${jsLabels.remove}</button>
        `;
        orderList.appendChild(item);
      });

      totalAmountDisplay.textContent = `${jsLabels.total}: ${total}円`;
    }

    function removeOrder(index) {
      orders.splice(index, 1);
      localStorage.setItem('orders', JSON.stringify(orders));
      renderOrders();
    }

    document.getElementById('checkout-btn').addEventListener('click', () => {
      if (orders.length === 0) {
        alert(jsLabels.no_order_alert);
        return;
      }

      const confirmOrder = confirm(jsLabels.confirm_order);

      if (confirmOrder) {
        fetch('submit_order.php', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({ orders: orders })
          })
          .then(response => response.json())
          .then(result => {
            if(result.status === 'success') {
              alert(jsLabels.thanks);
              localStorage.removeItem('orders');
              orders = [];
              renderOrders();
            } else {
              alert(jsLabels.fail_save + result.message);
            }
          })
          .catch(error => {
            alert("サーバーに接続できませんでした。");
            console.error('Error:', error);
          });
      }
    });
  </script>
</body>