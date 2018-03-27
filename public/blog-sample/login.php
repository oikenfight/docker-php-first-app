<?php
require_once('./functions.php');
session_start();

/*
 * 普通にアクセスした場合: GETリクエスト
 * 登録フォームからSubmitした場合: POSTリクエスト
 */
// POSTリクエストの場合
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // 送られた値を取得
    $username = $_POST['username'];
    $password = $_POST['password'];

    /**
     * 入力値チェック
     */
    // 未入力の項目があるか
    if (empty($username) || empty($password)) {
        $_SESSION["error"] = "入力されていない項目があります";
        header("Location: login.php");
        return;
    }

    /**
     * 認証
     */
    $db = connectDb();
    // 送られたusernameを使ってDBを検索する
    $sql = 'SELECT * FROM users WHERE username = :username';
    $statement = $db->prepare($sql);
    $statement->execute(['username' => $username]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    // ユーザーが取得できなかったら、それは入力されたusernameが間違っているということ
    if (!$user) {
        $_SESSION["error"] = "入力した情報に誤りがあります。";
        header("Location: login.php");
        return;
    }

    // パスワードとパスワード確認が一致しているか
    if (crypt($password, $user['password']) !== $user['password']) {
        $_SESSION["error"] = "入力した情報に誤りがあります。";
        header("Location: login.php");
        return;
    }

    // ログイン処理
    // ユーザー情報をセッションに格納する
    $_SESSION["user"]["id"] = $user['id'];
    $_SESSION["user"]["username"] = $user['username'];

    $_SESSION["success"] = "ログインしました。";
    header("Location: index.php");
}

?>

<html lang="ja">
<head>
    <meta charset="utf-8">
</head>
<body>
<div>
    <h3>WSD Blog</h3>
    <nav>
        <ul>
            <li><a href="user-register.php">新規登録</a></li>
            <li><a href="login.php">ログイン</a></li>
        </ul>
    </nav>

    <!-- Success Message -->
    <?php if(!empty($_SESSION['success'])): ?>
        <div class="alert alert-success" role="success">
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

    <h2>Twitterでログイン</h2>
    <a href="twitter-login.php">Twitterログインはこちら</a>


    <h2>ログイン</h2>

    <form action="" method="post">
        <div>
            <label for="username-input">ユーザー名</label>
            <input type="text" name="username" id="username-input" placeholder="">
        </div>
        <div>
            <label for="password-input">パスワード</label>
            <input type="password" name="password" id="password-input" placeholder="">
        </div>
        <input type="submit" value="ログイン">
    </form>

</div>
</body>
</html>