<?php
// functions.phpを読み込む. よく使う処理をまとめた関数を定義している
require_once('./functions.php');
// セッションを利用する
session_start();

/*
 * 普通にアクセスした場合: GETリクエスト
 * 登録フォームからSubmitした場合: POSTリクエスト
 */
// POSTリクエストの場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 送られた値を変数に格納
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password-confirmation'];

    /**
     * 入力値チェック
     */
    // 未入力の項目があるか
    if (empty($username) || empty($password) || empty($password_confirmation)) {
        $_SESSION["error"] = "入力されていない項目があります";
        header("Location: user-register.php");
        return;
    }

    // パスワードとパスワード確認が一致しているか
    if ($password !== $password_confirmation) {
        $_SESSION["error"] = "パスワードが一致しません";
        header("Location: user-register.php");
        return;
    }


    /**
     * 登録処理
     */
    // DB接続
    $db = connectDb();  // ※ この関数はfunctions.phpに定義してある
    // DBにインサート
    $sql = "INSERT INTO users(username, password) VALUES(:username, :password)";
    $statement = $db->prepare($sql);
    $result = $statement->execute([
        ':username' => $username,
        ':password' => crypt($password),
    ]);
    if (!$result) {
        die('Database Error');
    }

    // セッションにメッセージを格納
    $_SESSION["success"] = "登録が完了しました。ログインしてください。";
    // ログイン画面に遷移
    header("Location: login.php");
}
?>

<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <h3 class="text-muted">WSD Blog</h3>

    <nav>
        <ul class="nav nav-pills pull-right">
            <li role="presentation"><a href="user-register.php">新規登録</a></li>
            <li role="presentation"><a href="./login.php">ログイン</a></li>
        </ul>
    </nav>

    <h2>Twitterで登録</h2>
    <a href="./twitter-login.php">Twitterで登録するならこちら</a>

    <h2>新規登録</h2>

    <!-- Error Message -->
    <?php if(!empty($_SESSION['error'])): ?>
        <div>
            <pre><?php echo $_SESSION['error']; ?></pre>
            <?php $_SESSION['error'] = null; ?>
        </div>
    <?php endif; ?>

    <!-- 登録フォーム -->
    <form method="post" action="">
        <!-- ユーザー名 -->
        <div>
            <label for="username-input">ユーザー名</label>
            <input type="text" name="username" id="username-input" placeholder="">
        </div>
        <!-- パスワード -->
        <div>
            <label for="password-input">パスワード</label>
            <input type="password" name="password" id="password-input" placeholder="">
        </div>
        <!-- パスワード確認 -->
        <div>
            <label for="password-confirmation-input">パスワード確認</label>
            <input type="password" name="password-confirmation" id="password-confirmation-input" placeholder="">
        </div>
        <input type="submit" value="登録">
    </form>

</div>
</body>
</html>
