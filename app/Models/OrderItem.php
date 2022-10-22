<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;

final class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'orderable_type',
        'orderable_id',
        'supplier_id',
        'quantity',
        'actual_quantity',
        'total_box',
        'pieces_per_box',
        'price',
        'unit',
        'total_amount',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function orderable()
    {
        return $this->morphTo();
    }

    public function salesDrItem(): BelongsTo
    {
        return $this->belongsTo(SalesDrItem::class, 'id', 'sales_dr_item_id');
    }
}
