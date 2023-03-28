<?php

namespace Modules\Products\Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Products\App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Modules\Products\App\Models\Product>
 */
class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var Product $model
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() : array
    {
        return [
            'name'       => 'Product-1',
            'status'     => $this->model::STATUS_ACTIVE,
            'price'      => $this->faker->randomFloat(2, 1, 8),
            'type'       => $this->model::TYPE_SERVICE,
            'created_by' => User::first()
        ];
    }
}