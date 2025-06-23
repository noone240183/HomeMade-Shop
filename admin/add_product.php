<?php
// DB接続設定を読み込み
require_once '../db.php';

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $name_jp = $_POST["name_jp"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image_path = $_POST["image_path"];

    $sql = "INSERT INTO products (name, name_jp, description, price, image_path)
          VALUES (:name, :name_jp, :description, :price, :image_path)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':name_jp', $name_jp);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image_path', $image_path);

    if ($stmt->execute()) {
        $message = "商品が登録されました。";
    } else {
        $message = "登録に失敗しました。";
    }
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>商品登録フォーム</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 30px;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="number"] {
            width: 300px;
            padding: 5px;
        }

        input[type="submit"] {
            margin-top: 15px;
            padding: 8px 16px;
        }
    </style>
</head>

<body>

    <h2>商品登録フォーム</h2>

    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

    <form method="post">
        <label>商品名 (英語): <input type="text" name="name" required></label>
        <label>商品名 (日本語): <input type="text" name="name_jp"></label>
        <label>説明: <input type="text" name="description"></label>
        <label>価格 (円): <input type="number" name="price" required></label>
        <label>画像パス (例: images/sample.png): <input type="text" name="image_path" required></label>
        <input type="submit" value="登録する">
    </form>

</body>

</html>