<?php

namespace Modules\Products\App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Products\App\Http\Requests\StoreProductRequest;
use Modules\Products\App\Http\Requests\UpdateProductRequest;
use Modules\Products\App\Http\Resources\ProductCollection;
use Modules\Products\App\Interfaces\ProductRepositoryInterface;
use Modules\Products\App\Models\Product;
use Symfony\Component\HttpFoundation\Request;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\ResponseTrait;

class ProductController extends Controller
{

    use ResponseTrait;

    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return new ProductCollection($this->productRepository->getAllProducts($request->all())->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        return $this->productRepository->createProduct($request->all());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productRepository->updateProduct($product, $request->all());

        return $this->sendSuccessResponse(null, 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->productRepository->deleteProduct($product);

        return $this->sendSuccessResponse(null, 'Product deleted successfully.');
    }
}