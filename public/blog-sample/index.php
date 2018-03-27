<?php

require_once('./functions.php');
session_start();

// ログインしていなかったら、ログイン画面にリダイレクトする
redirectIfNotLogin(); // ※ この関数はfunctions.phpに定義してある

// DB接続
$db = connectDB(); // ※ この関数はfunctions.phpに定義してある
// 全記事を降順に取得するSQL文
$sql = 'SELECT * FROM articles ORDER BY id DESC';
// SQLを実行
$statement = $db->query($sql);
// 以下4行で、取得した記事を配列$articlesに格納している
$articles = [];
foreach ($statement->fetchAll(PDO::FETCH_ASSOC) as $article ) {
    $articles[]= $article;
}

?>

<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>WSD Blog</title>
    <link rel="stylesheet" href="./css/style.css">
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

    <!-- Success Message -->
    <?php if(!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" role="success">
            <pre><?php echo $_SESSION['success']; ?></pre>
            <?php $_SESSION['success'] = null; ?>
        </div>
    <?php endif; ?>

    <div>
        <h3>記事一覧</h3>
        <ul>
            <?php foreach($articles as $article): ?>
                <li>
                    <h3>
                        <!-- 記事詳細画面へのリンク -->
                        <a href="./article.php?id=<?php echo $article['id']; ?>">
                            <?php echo h($article['title']); ?>
                        </a>
                    </h3>
                    <hr>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

</div>
</body>
</html>