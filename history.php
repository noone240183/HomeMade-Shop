<?php
session_start();

// --- Language switch block START ---
if (isset($_GET['lang'])) {
  $_SESSION['lang'] = $_GET['lang'];
}
$lang = $_SESSION['lang'] ?? 'ja';

$labels = [
  'en' => [
    'title' => 'Order History',
    'no_orders' => 'No orders yet.',
    'order_time' => 'Order Time',
    'cancel' => 'Cancel',
    'back' => '← Back to Order Page',
    'confirm_cancel' => 'Are you sure you want to cancel this order?'
  ],
  'ja' => [
    'title' => '注文履歴',
    'no_orders' => 'まだ注文はありません。',
    'order_time' => '注文日時',
    'cancel' => 'キャンセル',
    'back' => '← 注文ページに戻る',
    'confirm_cancel' => 'この注文をキャンセルしてもよろしいですか？'
  ]
];
// --- Language switch block END ---

$user = "customer1"; // ここはログインユーザーIDに置き換えてください
$file = 'orders.json';

$orders_data = [];
if (file_exists($file)) {
    $orders_data = json_decode(file_get_contents($file), true);
}

$user_orders = $orders_data[$user] ?? [];
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
  <meta charset="UTF-8" />
  <title><?php echo $labels[$lang]['title']; ?></title>
  
  <style>
    body { font-family: Arial, sans-serif; padding: 30px; background: #fffefb; }
    h1 { color: #ff8000; font-size: 2.7em; letter-spacing: 1px; }
    .order-container { border: 2px solid #ccc; padding: 32px; margin-bottom: 38px; border-radius: 18px; background: #fff8e1; font-size: 1.25em; }
    .item { margin-bottom: 12px; font-size: 1.18em; }
    a { color: #339af0; text-decoration: none; font-weight: bold; font-size: 1.25em; }
    a:hover { text-decoration: underline; }
    button.cancel-btn {
      background: red; color: white; border: none; padding: 14px 32px; border-radius: 14px; cursor: pointer;
      font-weight: bold; font-size: 1.18em;
    }
    button.cancel-btn:hover {
      background: darkred;
    }
    form {
      margin-top: 22px;
    }
    .lang-btn {
      margin-right: 2px;
      font-size: 1.18em;
      padding: 8px 22px;
      border-radius: 7px;
      background: #339af0;
      color: #fff;
      font-weight: bold;
      border: none;
      transition: background 0.2s;
      text-decoration: none;
      display: inline-block;
    }
    .lang-btn:last-child {
      margin-right: 0;
    }
    .lang-btn:hover {
      background: #1971c2;
    }
    /* Center the main content */
    .history-center {
      max-width: 800px;
      margin: 0 auto;
      background: #fff;
      border-radius: 24px;
      box-shadow: 0 4px 32px rgba(0,0,0,0.13);
      padding: 64px 48px;
    }
    @media (max-width: 700px) {
      .history-center {
        padding: 18px 2vw;
        max-width: 98vw;
      }
      h1 { font-size: 2em; }
      a { font-size: 1em; }
    }
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    .history-wrapper {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .lang-switch-row {
      margin-bottom: 24px;
      text-align: center;
      display: flex;
      justify-content: center;
      gap: 8px;
    }
    /* Modal styles */
    #imgModal {
      display: none;
      position: fixed;
      z-index: 9999;
      left: 0; top: 0;
      width: 100vw; height: 100vh;
      background: rgba(0,0,0,0.7);
      align-items: center;
      justify-content: center;
    }
    #imgModal.active {
      display: flex;
    }
    #imgModal img {
      max-width: 90vw;
      max-height: 80vh;
      border-radius: 18px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.4);
      background: #fff;
    }
    #imgModal span.close {
      position: absolute;
      top: 30px;
      right: 50px;
      color: #fff;
      font-size: 3em;
      cursor: pointer;
      font-weight: bold;
      z-index: 10001;
    }
    #modalCaption {
      color: #fff;
      text-align: center;
      margin-top: 18px;
      font-size: 1.3em;
    }
  </style>
</head>
<body>

  <!-- Language Switch Option -->
  <div class="lang-switch-row">
    <a href="?lang=en" class="lang-btn"<?php if($lang=='en') echo ' style="font-weight:bold;"'; ?>>English</a>
    <a href="?lang=ja" class="lang-btn"<?php if($lang=='ja') echo ' style="font-weight:bold;"'; ?>>日本語</a>
  </div>
  <div class="history-wrapper">
    <div class="history-center">
      <h1 style="text-align:center;">📦 <?php echo $labels[$lang]['title']; ?></h1>

      <?php if (empty($user_orders)): ?>
        <p style="text-align:center;"><?php echo $labels[$lang]['no_orders']; ?></p>
      <?php else: ?>
        <?php foreach ($user_orders as $index => $order_set): ?>
          <div class="order-container">
            <div><strong><?php echo $labels[$lang]['order_time']; ?>: </strong><?= htmlspecialchars($order_set['timestamp']) ?></div>
            <ul style="list-style:none; padding:0;">
              <?php foreach ($order_set['orders'] as $item): ?>
                <li class="item" style="display:flex; align-items:center; gap:18px; margin-bottom:18px;">
                  <?php if (!empty($item['image'])): ?>
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                      style="width:60px; height:60px; object-fit:cover; border-radius:8px; border:1px solid #ccc; cursor:pointer;"
                      onclick="showLargeImage(this.src, '<?= htmlspecialchars(addslashes($item['name'])) ?>')">
                  <?php else: ?>
                    <span style="width:60px; height:60px; display:inline-block; background:#eee; border-radius:8px; border:1px solid #ccc;"></span>
                  <?php endif; ?>
                  <span><?= htmlspecialchars($item['name']) ?> - ￥<?= htmlspecialchars($item['price']) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>

            <form method="POST" action="cancel_order.php" onsubmit="return confirm('<?php echo $labels[$lang]['confirm_cancel']; ?>');">
              <input type="hidden" name="user" value="<?= htmlspecialchars($user) ?>">
              <input type="hidden" name="order_index" value="<?= $index ?>">
              <button type="submit" class="cancel-btn"><?php echo $labels[$lang]['cancel']; ?></button>
            </form>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <div style="text-align:center; margin-top: 48px;">
        <a href="order.php"><?php echo $labels[$lang]['back']; ?></a>
      </div>
    </div>
  </div>

  <!-- Modal for large image -->
  <div id="imgModal">
    <span class="close" onclick="closeLargeImage()">&times;</span>
    <img id="modalImg" src="" alt="">
    <div id="modalCaption"></div>
  </div>
  <script>
    function showLargeImage(src, caption) {
      document.getElementById('modalImg').src = src;
      document.getElementById('modalCaption').textContent = caption;
      document.getElementById('imgModal').classList.add('active');
    }
    function closeLargeImage() {
      document.getElementById('imgModal').classList.remove('active');
    }
    window.addEventListener('keydown', function(e){
      if(e.key === "Escape") closeLargeImage();
    });
    // Optional: close modal when clicking outside the image
    document.getElementById('imgModal').addEventListener('click', function(e) {
      if (e.target === this) closeLargeImage();
    });
  </script>
</body>
</html>