## Basic Usage

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