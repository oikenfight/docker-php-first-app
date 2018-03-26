# docker/phpmyadmin/README.md

nginx 側の設定も変更し、 /phpmyadmin/ でアクセスできるようにした。

docker-compose.yml で port を 8080 とかに設定して使おうとしたけど、https にしたかったのでこうした。