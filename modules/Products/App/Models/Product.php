<?php

namespace Modules\Products\App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Modules\Products\Database\Factories\ProductFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const TYPE_ITEM = 0;
    const TYPE_SERVICE = 1;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    const TYPE_ITEM_LABEL = 'Item';
    const TYPE_SERVICE_LABEL = 'Service';

    const STATUS_INACTIVE_LABEL = 'Inactive';
    const STATUS_ACTIVE_LABEL = 'Active';

    public static $productTypes = [
        self::TYPE_ITEM => self::TYPE_ITEM_LABEL,
        self::TYPE_SERVICE => self::TYPE_SERVICE_LABEL
    ];

    public static $productStatus = [
        self::STATUS_INACTIVE => self::STATUS_INACTIVE_LABEL,
        self::STATUS_ACTIVE => self::STATUS_ACTIVE_LABEL
    ];

    protected $fillable = [
        'name',
        'price',
        'type'
    ];

    public function createdBy() : BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function audits() : MorphMany
    {
        return $this->morphMany(Audit::class, 'auditable');
    }

    /** @return ProductFactory */
    protected static function newFactory()
    {
        return ProductFactory::new ();
    }

}