# Additional Usage

フレームワークなどを使いたい人向けのドキュメント。

## PHP

php コンテナを起動して、php コマンドを利用できる
```bash
$ docker-compose run --rm php --version
```
    
## Composer

composer コンテナを起動して、composer コマンドを利用できる
```bash
$ docker-composer run --rm composer --version
```

## Laravel

PHP のフレームワークの1つ。初心者にはやや難しいのでプログラミング経験者向け。

### Project Start
* プロジェクト作成
    ```bash
    $ docker-compose run --rm composer create-project laravel/laravel your-app-name
    ```

* 適切な場所にファイルを配置
    ```bash
    $ mv ./your-app-name/* ./
    ```
    ※ いくつか名前がぶつかるので、そこは上手くやること

* `https://(localhost or 各自 IP)` にアクセス

* `artisan` コマンドの実行
    ```bash
    $ docker-composer run --rm php artisan [SOME COMMAND]
    ```
    
### Others

* さらに色々な機能を使用したい場合は `app` コンテナ内で作業する
    ```bash
    $ docker exec -it [CONTAINER NAME or ID] sh
    ```
    ※ （例えば、npm コマンド使いたいとか）

※ コンテナのベースイメージは alpine linux であることに注意