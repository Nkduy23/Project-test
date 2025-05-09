<?php

namespace App\Core;

use App\Controllers\HomeController;
use App\Models\ProductModel;
use PDO;
use PDOException;

class ControllerFactory
{
    public static function create(string $controllerClass)
    {
        // Tạo kết nối PDO
        $db = self::makePDO();

        switch ($controllerClass) {
            case HomeController::class:
                $productModel = new ProductModel($db);
                return new HomeController($productModel);

            default:
                return new $controllerClass();
        }
    }

    protected static function makePDO(): PDO
    {
        try {
            $host = 'localhost';
            $dbname = 'product_test'; // đảm bảo database này đã tồn tại
            $username = 'root';
            $password = '';

            $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
            return new PDO($dsn, $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
}
