<?php

return [
    'db' => [
        'database' => 'app', // データベースの名前 (docker/mysql/mysql.env に記載)
        'user' => 'app_user', // MySQLのユーザー名 (docker/mysql/mysql.env に記載)
        'password' => 'user_pass', // MySQLのパスワード (docker/mysql/mysql.env に記載)
        'host' => 'mysql' // MySQLのホスト (docker-compose でデータベースのコンテナ名を "mysql" としている)
    ]
];
