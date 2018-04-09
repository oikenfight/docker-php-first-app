# ウェブサービス開発環境構築

ウェブサービス構築の実習で使用する環境を Docker で構築。

## 環境
* PHP7.2 (7.2-fpm-alpine)
* Nginx
* MySQL5.7

## Getting Started

### Docker の準備

#### Mac の人
1. [Docker for Mac](https://docs.docker.com/docker-for-mac/install/) をダウンロードする
    * stable を選択すること
2. Docker for Mac を起動
    * 参考: https://qiita.com/scrummasudar/items/750aa52f4e0e747eed68
3. Docker の確認
    * [Get started with Docker for Mac](https://docs.docker.com/docker-for-mac/)に従って確認できる
    * 以下のコマンドが通れば完了
    ```$xslt
    $ docker --version
    $ docker-compose --verison
    $ docker-machine --version

    ```
    
#### Windows の人
1. [Docker toolbox](https://docs.docker.com/toolbox/overview/) をダウンロードする
2. Docker をインストールする
    * 参考: https://docs.docker.com/toolbox/toolbox_install_windows/
    * 参考: https://qiita.com/maemori/items/52b1639fba4b1e68fccd
3. Docker の確認
    * 以下のコマンドが通ることを確認
    ```$xslt
    $ docker --version
    $ docker-compose --verison
    $ docker-machine --version

    ```
    
### 必要なファイルを準備

1. 以下のリンクから環境構築に使うファイルをダウンロードする
    * https://github.com/oikenfight/docker-php-first-app
    * 右の方にある緑色の Clone or download ボタンから ZIP を選択
2. ダウンロードしたファイルを適当な場所に移動して完了


### 環境構築

1. CLI でダウンロードしたファイルがある場所に移動
2. 以下のコマンドを実行
    ```$xslt
    $ docker-compose build
    $ docker-compose up -d 
    ```
3. 起動確認
    ```$xslt
    $ docker-compose ps
    ```
4. 動作確認
    * Mac の場合
        - https://localhost にアクセス
        - php の画面が表示されれば完了

    * Windows の人
        - 以下のコマンドで Docker の IP を調べる （VM 名は特に何もしてなければ default）
        ```$xslt
        $ docker-machine ip (使用している VM 名)
        ```
        - https://(調べたIPアドレス) にアクセス
        - php の画面が表示されれば完了
        
※ 注意： ブラウザでアクセスすると最初に「この接続ではプライバシーが保護されません」と警告がでるけど無視（ssl認証を自己認証にしているため発生）。
「詳細情報」をクリックして「アクセスする（安全ではありません）」をクリック。


## 基本的な進め方

* `public/` に .php ファイルを作ればブラウザから見れる
    - 例：
         + `public/test/test.php` を作成
         + https://(localhost or 各自 IP)/test/test.php にアクセス
         + `test.php` の内容が表示される
    - public/ の下に自分のアプリケーションを置くためのディレクトリを作成して作業開始！
* データベースの使い方
    - phpmyadmin を活用する
    - https://(localhost or 各自 IP)/phpmyadmin/ にアクセス
    - 左メニューに app というデータベースを選択
    - app データベース内のテーブルを操作する
* log の活用
    - 以下のコマンドで php のエラーログを見たりすると便利
    ```$xslt
    $ tail -f logs/php/fpm-php.www.log
    ```
    - 何かエラーがある度に自動更新してくれる
        
## サンプルアプリケーション

### 動かし方

1. データベースを作成する
    1. `public/blog-sample/db_scheme.sql` を開いて内容を全てコピーしておく
    2. https://(localhost or 各自IP)/phpmyadmin/ にアクセスして phpmyadmin を開く
    3. 左にあるメニューから app を選択
    4. 画面上の方のタブメニューから「SQL」を選択
    5. テキストエリアにコピーしておいて sql を貼り付ける
    6. 実行ボタンをクリック
    7. 画面上の方のタブメニューから「構造」を選択し、articles, users テーブルがあることを確認
2. アプリケーションを試す
    1. https://(localhost or 各自IP)/blog-sample/ にアクセス
    2. 新規登録してスタート
    
※ Twitter ログインは今のところ対応してない

### 要件
- ユーザー名とパスワードを用いたユーザー登録と認証
- Twitterアカウントを用いた登録と認証
- 新規記事投稿
- 投稿記事表示

### 構成
- 登録: `user-register.php  `
- ログイン: `login.php`   
- Twitterで登録&ログイン `twitter-login.php`
- 一覧: `index.php`
- 詳細: `article.php`
- 新規投稿: `new-article.php`
- DB情報は`config.php`にて定義
- 複数箇所で呼ばれる処理は関数に纏め、`functions.php`に定義
