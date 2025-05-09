<?php

namespace App\Controllers;

use App\Models\ProductModel;

class HomeController
{
    protected $productModel;

    public function __construct(ProductModel $productModel)
    {
        $this->productModel = $productModel;
    }

    public function index()
    {
        $products = $this->productModel->getFeaturedProducts();

        require_once __DIR__ . '/../../app/Views/home.php';
    }
}
