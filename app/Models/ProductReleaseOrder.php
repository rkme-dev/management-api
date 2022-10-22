<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class ProductReleaseOrder extends Model
{
    use HasFactory;

    protected $table = 'product_release_orders';

    protected $fillable = [
        'product_id',
        'release_order_id',
        'created_by',
        'total_boxes',
        'total_pieces',
        'created_by',
    ];

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getReleaseOrder(): ReleaseOrder
    {
        return $this->releaseOrder;
    }

    public function releaseOrder(): BelongsTo
    {
        return $this->belongsTo(ReleaseOrder::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
