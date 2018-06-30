<?php
require_once('./functions.php');
session_start();

// ログインしていなかったらログイン画面に遷移
redirectIfNotLogin();  // ※ この関数はfunctions.phpに定義してある

// DB接続
$db = connectDB();
$sql = 'SELECT * FROM images ORDER BY id DESC';
$statement = $db->query($sql);
$images = [];
foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $image ) {
    $images[]= $image;
}

/*
 * 普通にアクセスした場合: GETリクエスト
 * 登録フォームからSubmitした場合: POSTリクエスト
 */
// POSTリクエストの場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tmpfile = $_FILES['file']['tmp_name'];
    if (is_uploaded_file($tmpfile)) {

        $filename = $_FILES['file']['name'];
        $destination = 'images/' . $filename;

        if (!move_uploaded_file($tmpfile, $destination)) {
            $_SESSION["error"] = "アップロードに失敗しました。";
        }

        // 画像を登録
        $sql = "INSERT INTO images(name) VALUES(:name)";
        $statement = $db->prepare($sql);
        $result = $statement->execute([
            ':name' => $filename,
        ]);

        if (!$result) {
            die('Database Error');
        }

        $_SESSION["success"] = "画像をアップロードしました";
        // 一覧画面に遷移
        header("Location: new-image.php");

    } else {
        $_SESSION["error"] = "ファイルを選択してください。";
    }

}

?>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>WSD Blog</title>
</head>
<body>

<div>

    <h2>画像投稿</h2>

    <!-- Success Message -->
    <?php if(!empty($_SESSION['success'])): ?>
        <div>
            <pre><?php echo $_SESSION['success']; ?></pre>
            <?php $_SESSION['success'] = null; ?>
        </div>
    <?php endif; ?>

    <!-- Error Message -->
    <?php if(!empty($_SESSION['error'])): ?>
        <div>
            <pre><?php echo $_SESSION['error']; ?></pre>
            <?php $_SESSION['error'] = null; ?>
        </div>
    <?php endif; ?>


    <form action="" method="post" enctype="multipart/form-data">
        <!-- Name -->
        <div class="">
            <label for="file" class="">画像</label>
            <input type="file" name="file" id="file">
        </div>

        <!-- Submit -->
        <input type="submit" value="アップロード">
    </form>

    <div>
        <h2>画像一覧</h2>
        <ul>
            <?php foreach($images as $image): ?>
                <li>
                    <h3>
                        <!-- 記事詳細画面へのリンク -->
                        <p><?php echo h($image['name']); ?></p>
                        <img src="images/<?php echo h($image['name']); ?>" style="width: 80px; height: 100px">
                    </h3>
                    <hr>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>

</body>
</html>