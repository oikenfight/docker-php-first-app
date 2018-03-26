# docker/app/README.md

## docker/app/user/local/etc/php/conf.d/php.ini
docker の標準出力にてエラーを確認できるように以下を変更
```
log_errors = On
error_log = /dev/stderr
```

その他は適当に設定

## docker/app/user/local/etc/php-fpm.d/

次の3ファイルを上書き
- [docker.conf](usr/local/etc/php-fpm.d/docker.conf)
- [www.conf](usr/local/etc/php-fpm.d/www.conf)
- [zz-docker.conf](usr/local/etc/php-fpm.d/zz-docker.conf)

基本的には元々の設定と同じ状態。
www.conf のみローカルの /logs/fpm-php/ にマウントしたいため以下に変更。
```$xslt
php_flag[display_errors] = on
php_admin_value[error_log] = /var/log/fpm-php.www.log
php_admin_flag[log_errors] = on
```
