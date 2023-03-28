<?php

namespace Modules\Products\App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Audit extends Model
{
    use HasFactory;

    protected $fillable = [
        'old_value',
        'new_value',
        'product_id',
        'updated_by'
    ];

    protected $casts = [
        'old_value' => 'json',
        'new_value' => 'json',
    ];

    public function auditable() : MorphTo
    {
        return $this->morphTo();
    }
}