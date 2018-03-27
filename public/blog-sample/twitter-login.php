<?php
require("./hybridauth/hybridauth/Hybrid/Auth.php");
session_start();
require_once('./functions.php');

// ツイッター認証
$auth = new Hybrid_Auth( "./hybridauth/hybridauth/config.php" );
$twitter = $auth->authenticate("Twitter");
$profile = $twitter->getUserProfile();

// ツイッターAPIから返ってきたツイッターIDとツイッター上のユーザー名を変数に入れておく
$twitter_id = $profile->identifier;
$username = $profile->displayName;

// すでに登録済みか確認する
$db = connectDb();
$sql = 'SELECT * FROM users WHERE twitter_id = :twitter_id';
$statement = $db->prepare($sql);
$statement->execute(['twitter_id' => $twitter_id]);
$user = $statement->fetch(PDO::FETCH_ASSOC);

// 未登録(初めて)の場合は、登録処理をする
if (!$user) {
    $sql = "INSERT INTO users(username, twitter_id) VALUES(:username, :twitter_id)";
    $statement = $db->prepare($sql);
    $result = $statement->execute([
        ':username' => $username,
        ':twitter_id' => $twitter_id,
    ]);
    if (!$result) {
        die('Database Error');
    }

    // 登録したユーザーを取得し、変数$userに格納
    $sql = 'SELECT * FROM users WHERE twitter_id = :twitter_id';
    $statement = $db->prepare($sql);
    $statement->execute(['twitter_id' => $twitter_id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
}

// ログイン処理
$_SESSION['user']['id'] = $user['id'];
$_SESSION['user']['username'] = $user['username'];

$_SESSION["success"] = "ログインしました。";
// 一覧画面
header("Location: index.php");