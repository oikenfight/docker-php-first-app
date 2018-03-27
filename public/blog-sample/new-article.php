<?php
require_once('./functions.php');
session_start();

// ログインしていなかったらログイン画面に遷移
redirectIfNotLogin();  // ※ この関数はfunctions.phpに定義してある

/*
 * 普通にアクセスした場合: GETリクエスト
 * 登録フォームからSubmitした場合: POSTリクエスト
 */
// POSTリクエストの場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 未入力の値が無いか
    if (empty($_POST['title']) || empty($_POST['body'])) {
        $_SESSION["error"] = "タイトルと本文を入力してください。";
        header("Location: index.php");
        return;
    }

    // 記事を登録
    $db = connectDb();
    $sql = "INSERT INTO articles(user_id, title, body) VALUES(:user_id, :title, :body)";
    $statement = $db->prepare($sql);
    $result = $statement->execute([
        ':user_id' => $_SESSION['user']['id'],
        ':title' => $_POST['title'],
        ':body' => $_POST['body'],
    ]);
    if (!$result) {
        die('Database Error');
    }

    $_SESSION["success"] = "記事を投稿しました";
    // 一覧画面に遷移
    header("Location: index.php");
}



?>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>WSD Blog</title>
</head>
<body>

<div>

    <h2>WSD Blog</h2>

    <nav>
        <ul>
            <li><a href="./index.php">一覧</a></li>
            <li><a href="new-article.php">投稿</a></li>
            <li><a href="./logout.php">ログアウト</a></li>
        </ul>
    </nav>

    <form action="" method="post">

        <!-- Error Message -->
        <?php if(!empty($_SESSION['error'])): ?>
            <div>
                <pre><?php echo $_SESSION['error']; ?></pre>
                <?php $_SESSION['error'] = null; ?>
            </div>
        <?php endif; ?>

        <!-- Title -->
        <div class="form-group">
            <label for="title" class="control-label">タイトル</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="">
        </div>

        <!-- Body -->
        <div>
            <label for="body">本文</label>
            <textarea name="body" rows="20" placeholder=""></textarea>
        </div>

        <!-- Submit -->
        <input type="submit" value="投稿">

    </form>

</div>

</body>
</html>