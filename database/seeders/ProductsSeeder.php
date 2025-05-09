<?php

$db = require __DIR__ . '/../../config/database.php';

$pdo = new PDO(
    "mysql:host={$db['host']};dbname={$db['name']}", 
    $db['user'], 
    $db['pass']
);

// Dữ liệu mẫu
$products = require __DIR__ . './products_data.php';

$stmt = $pdo->prepare("
    INSERT INTO products (name, description, price, image_path) 
    VALUES (:name, :description, :price, :image_path)
");

foreach ($products as $product) {
    $stmt->execute($product);
}

echo "Đã thêm " . count($products) . " sản phẩm vào database\n";