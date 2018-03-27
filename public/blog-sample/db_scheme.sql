CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    twitter_id VARCHAR(255),
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255),
    created_at DATETIME,
    modified_at DATETIME
);

CREATE TABLE articles (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    title VARCHAR(50) NOT NULL,
    body TEXT NOT NULL,
    created_at DATETIME,
    modified_at DATETIME
);
