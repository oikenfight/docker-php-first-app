<?php

// DB接続
function connectDB()
{
    $config = require_once('./config.php');
    $dsn = "mysql:dbname=" . $config['db']['database'] . ";host=" . $config['db']['host'].';charset=utf8;';

    try {
        $db = new PDO($dsn, $config['db']['user'], $config['db']['password']);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (PDOException $e) {
        die('Connecting database failed:' . $e->getMessage());
    }

    return $db;
}

// ログインしていなかったらログインページへリダイレクトする
function redirectIfNotLogin()
{
    // ログインしてなかったら
    if (!isset($_SESSION['user'])) {
        // ログインページヘリダイレクトする
        header('Location: login.php');
        return;
    }
}

// ログインしているユーザーの情報を取得する
function loginUser()
{
    return $_SESSION['user'];
}

// ユーザーから入力された文字を安全な文字列に変換する(HTMLエスケープ)
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
