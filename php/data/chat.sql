CREATE DATABASE konga_chat;
USE konga_chat;
CREATE TABLE IF NOT EXISTS users(
email VARCHAR(50) NOT NULL,
user_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
password VARCHAR(50) NOT NULL,
status BOOLEAN NOT NULL DEFAULT 1
);

CREATE TABLE IF NOT EXISTS message(
`text` TEXT NOT NULL,
recipient INT NOT NULL,
sender INT NOT NULL,
date_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);