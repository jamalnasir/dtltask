<?php

namespace Modules\Products\App\Observers;

use Illuminate\Support\Facades\Auth;
use Modules\Products\App\Models\Product;
use Modules\Products\App\Notifications\NewProductEmailNotification;

class ProductObserver
{
    /**
     * Handle the Product "creating" event.
     */
    public function creating(Product $product) : void
    {
        $product->created_by = auth()->id();
    }


    /**
     * Handle the Product "created" event.
     */
    public function created(Product $product) : void
    {
        $product->createdBy()->first()->notify(new NewProductEmailNotification($product));
    }

    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product) : void
    {
        $oldValues = $product->getOriginal();
        $newValues = $product->getAttributes();

        $ignoreDataPoints = ['created_at', 'updated_at'];

        $modifiedDataPoints = array_diff_assoc($newValues, $oldValues);
        $modifiedDataPoints = array_diff_key($modifiedDataPoints, array_flip($ignoreDataPoints));

        $oldValues = array_intersect_key($oldValues, $modifiedDataPoints);

        $audit = [
            'old_value' => $oldValues,
            'new_value' => $modifiedDataPoints
        ];

        $product->audits()->create($audit);
    }
}