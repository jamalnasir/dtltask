<?php

namespace Modules\Products\App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\Products\App\Models\Product;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request) : array
    {
        return [
            'id'          => $this->id,
            'status'      => Product::$productStatus[$this->status],
            'name'        => $this->name,
            'price'       => (float) $this->price,
            'type'        => Product::$productTypes[$this->type],
            'createdBy'   => isset($this->createdBy) ? $this->createdBy->name : $this->uname,
            'createdDate' => $this->created_at->format('Y-m-d')
        ];
    }
}