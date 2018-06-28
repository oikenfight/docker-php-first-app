FROM mysql:5.7

# 初期データを流し込めそうな気がしたけど、上手く行ってない
# ADD "docker/mysql/docker-entrypoint-initdb.d/initial.sql" "/docker-entrypoint-initdb.d"

RUN apt-get update -y

COPY docker/mysql/etc/mysql/conf.d/log.cnf /etc/mysql/conf.d/log.cnf
RUN chmod 644 /etc/mysql/conf.d/log.cnf