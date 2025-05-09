<?php

require __DIR__ . '/../../vendor/autoload.php';

$db = require __DIR__ . '/../../config/database.php';

$pdo = new PDO(
    "mysql:host={$db['host']};dbname={$db['name']}",
    $db['user'],
    $db['pass']
);

// Tạo bảng
$pdo->exec("
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)");
