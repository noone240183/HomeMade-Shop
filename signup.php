<?php
require_once 'db.php'; // データベース接続設定を読み込み

session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
  if ($stmt->execute([$name, $email, $password])) {
    $_SESSION['user'] = ['name' => $name, 'email' => $email];
    header("Location: index.php");
    exit;
  } else {
    $error = "メールがすでに登録されています。";
  }
}
?>

<!-- signup form -->
<form method="post">
  名前: <input type="text" name="name" required><br>
  メール: <input type="email" name="email" required><br>
  パスワード: <input type="password" name="password" required><br>
  <button type="submit">サインアップ</button>
  <?php if (isset($error)) echo "<p>$error</p>"; ?>
</form>
