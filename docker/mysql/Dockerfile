FROM mysql:5.7

ADD "docker/mysql/docker-entrypoint-initdb.d/initial.sql" "/docker-entrypoint-initdb.d"

RUN apt-get update -y