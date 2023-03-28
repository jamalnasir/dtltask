<?php

namespace Modules\Products\App\Interfaces;

use Modules\Products\App\Models\Product;

interface ProductRepositoryInterface
{
    public function getAllProducts(array $filters = []);
    public function getProductById(int $productId);
    public function deleteProduct(Product $product);
    public function createProduct(array $productDetails);
    public function updateProduct(Product $product, array $newDetails);
}