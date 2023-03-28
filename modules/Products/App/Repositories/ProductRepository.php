<?php

namespace Modules\Products\App\Repositories;

use Modules\Products\App\Interfaces\ProductRepositoryInterface;
use Modules\Products\App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @param array $filters
     * @return mixed
     */
    public function getAllProducts(array $filters = array())
    {
        $products = Product::with('createdBy')->select('id', 'name', 'created_by', 'created_at', 'price', 'status', 'type');

        if (isset($filters['name'])) {
            $products->where('name', 'like', '%' . $filters['name'] . '%');
        }

        return $products;
    }

    /**
     *
     * @param int $productId
     * @return mixed
     */
    public function getProductById(int $productId)
    {
    }

    /**
     *
     * @param int $productId
     * @return mixed
     */
    public function deleteProduct(Product $product)
    {
        return $product->delete();
    }

    /**
     *
     * @param array $productDetails
     * @return mixed
     */
    public function createProduct(array $productDetails)
    {
        return Product::create($productDetails);
    }

    /**
     *
     * @param int $productId
     * @param array $newDetails
     * @return mixed
     */
    public function updateProduct(Product $product, array $newDetails)
    {
        return $product->update($newDetails);
    }
}