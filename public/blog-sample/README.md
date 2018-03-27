## WSD BlogをC4SAで動かす手順
- キャンバスを開く
- 「PHPバージョン管理」からバージョンを5.4に変更
- プログラムをGithubからコピーしてくる
    1. 「ファイル」からpublic_htmlフォルダをクリック。中にindex.phpがあればOK
    1. 「Git登録」（WebDAVの左のボタン）をクリック。以下の内容を入力して実行
        - リポジトリURL：https://github.com/shotana/WSD-Blog.git
        - ディレクトリ名：wsd_blog
- データベースを作る。
    1. 「ファイル」からwsd_blogフォルダの中の`db_schema.sql`を開き、内容を全てコピーしておく
    1. 「共有MySQL」メニューからphpMyAdminの管理画面を開く
    1. 左のリストから自分のデータベースの名前をクリック
    1. 「SQL」をクリック
    1. テキストエリアに コピーしておいたdb_schema.sql の内容を貼り付ける
    1. 実行
    2. 確認：「構造」をクリックして、テーブルが２つ、「articles」と「users」があればOK
- PHPからデータベースに接続するための設定
    1. 「共有MySQL」メニューの「ローカルIP」「ユーザー」「パスワード」をコピーしておく
    1. 「ファイル」からconfig.phpを開く
    1.  5行目の `DATABASE_NAME` の部分をコピーしたユーザーの値に置き換え
    1.  6行目の `USERNAME` の部分をコピーしたユーザーの値に置き換え
    1.  5行目の `PASSWORD` の部分をコピーしたパスワードの値に置き換え
    1.  5行目の `HOST` の部分をコピーしたローカルIPの値に置き換え

- TwitterAPIの設定
    1. TwitterRestAPIのページでアプリケーション登録を行う
        1. `https://apps.twitter.com/app/new`を開き、フォームに下記のように入力する
            - Name: アプリケーション名。好きな名前を入力する
            - Description：適当な説明を入力する。10文字以上
            - Website: 自分のキャンバスのURL + `wsd_blog`とする。例えば自分のキャンバスのURLが`abc.com`ならば `http://abc.com/wsd_blog` とする
            - Callback Url: 自分のキャンバスのURL + `wsd_blog/twitter-login.php`とする。例えば自分のキャンバスのURLが`abc.com`ならば `http://abc.com/wsd_blog/twitter-login.php` とする
            - 規約に同意するチェックを入れて、ボタン「Create Your Twitter Application」を押下
    1. 上で登録したアプリケーションのページを開き、「Keys And Access Tokens」のタブを選択する。「Consumer Key (API Key)」「Consumer Secret (API Secret)」の値を控えておく。`hybridauth/hybridauth/config.php`  の39行目の`key`にConsumer Keyの値、`secret`にConsumer Secretの値を入れる
    1. `hybridauth/hybridauth/config.php` の14行目の `base_url` を書き換える. `http://自分のキャンバスのURL/wsd_blog/hybridauth/hybridauth/`とする。例えば自分のキャンバスのURLが`abc.com`ならば `http://abc.com/wsd_blog/hybridauth/hybridauth/` とする。末尾の`/`を忘れないように注意

## 要件
- ユーザー名とパスワードを用いたユーザー登録と認証
- Twitterアカウントを用いた登録と認証
- 新規記事投稿
- 投稿記事表示

## 構成
- 登録: `user-register.php  `
- ログイン: `login.php`   
- Twitterで登録&ログイン `twitter-login.php`
- 一覧: `index.php`
- 詳細: `article.php`
- 新規投稿: `new-article.php`
- DB情報は`config.php`にて定義
- 複数箇所で呼ばれる処理は関数に纏め、`functions.php`に定義

## dependency
- Twitter認証 -> [HybridAuth](http://hybridauth.sourceforge.net/)

## バージョン情報
- PHP 5.4 (C4SAと同じ)
- MySQL 5.5 (C4SAと同じ)
