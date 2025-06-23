<?php
// DB接続設定を読み込み
require_once '../db.php';

$message = '';

// フォームが送信された場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST["name"];
    $name_jp = $_POST["name_jp"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    // アップロード処理
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../images/uploads/';
        $fileName = basename($_FILES['image']['name']);
        $uploadPath = $uploadDir . $fileName;

        // ファイルを移動
        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath)) {
            $image_path = $uploadPath;
        } else {
            $message = "画像のアップロードに失敗しました。";
        }
    } else {
        $message = "画像が選択されていません。";
    }

    // エラーがなければDBへ登録
    if (empty($message)) {
        $sql = "INSERT INTO products (name, name_jp, description, price, image_path)
                VALUES (:name, :name_jp, :description, :price, :image_path)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':name_jp', $name_jp);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':image_path', $fileName);

        if ($stmt->execute()) {
            $message = "商品が登録されました。";
        } else {
            $message = "登録に失敗しました。";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>商品登録フォーム</title>
    <style>
        body { font-family: sans-serif; margin: 30px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="number"], input[type="file"] {
            width: 300px; padding: 5px;
        }
        input[type="submit"] {
            margin-top: 15px; padding: 8px 16px;
        }
    </style>
</head>
<body>

<h2>商品登録フォーム</h2>
<?php if (!empty($message)) echo "<p>$message</p>"; ?>

<form method="post" enctype="multipart/form-data">
    <label>商品名 (英語): <input type="text" name="name" required></label>
    <label>商品名 (日本語): <input type="text" name="name_jp"></label>
    <label>説明: <input type="text" name="description"></label>
    <label>価格 (円): <input type="number" name="price" required></label>
    <label>商品画像: <input type="file" name="image" accept="image/*" required></label>
    <input type="submit" value="登録する">
</form>

</body>
</html>
