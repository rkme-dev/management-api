<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class StockRequestProduceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_request_id',
        'quantity_of_unit',
        'total_pieces',
        'unit_id',
        'product_id',
    ];

    protected $table = 'stock_request_produce_items';

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitPacking::class, 'unit_id');
    }
}
