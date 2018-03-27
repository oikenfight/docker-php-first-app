<?php

require_once('./functions.php');
session_start();
// ログインしていなかったら、ログイン画面にリダイレクトする
redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある

// URLに含まれている記事のIDを取得
$id = $_GET['id'];
// DB接続
$db = connectDB();
// 以下4行、記事をDBから取得し、変数$articleに格納
$sql = 'SELECT * FROM articles WHERE id = :id';
$statement = $db->prepare($sql);
$statement->execute(['id' => $_GET['id']]);
$article = $statement->fetch(PDO::FETCH_ASSOC);
// 以下2行、記事を投稿したユーザーを取得し、変数$article_userに格納
$statement = $db->query('SELECT * FROM users WHERE id = ' . $article['user_id']);
$article_user = $statement->fetch(PDO::FETCH_ASSOC);

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
            <li><a href="index.php">一覧</a></li>
            <li><a href="new-article.php">投稿</a></li>
            <li><a href="logout.php">ログアウト</a></li>
        </ul>
    </nav>

    <h1 id="article-title">
        <?php echo h($article['title']); ?>
    </h1>

    <p id="article-meta">
        <i class="glyphicon glyphicon-user"></i>&nbsp;<?php echo h($article_user['username']) ?>&nbsp;&nbsp;
    </p>

    <pre id="article-body" style="background: white; border:none; font-size:18px; padding: 0; margin-top: 30px;"><?php echo h($article['body']); ?></pre>

</div>
</body>
</html>