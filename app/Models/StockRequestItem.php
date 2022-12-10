<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class StockRequestItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'stock_request_id',
        'quantity_of_unit',
        'total_pieces',
        'unit_id',
        'raw_material_id',
    ];

    protected $table = 'stock_request_items';

    public function rawMaterial(): BelongsTo
    {
        return $this->belongsTo(RawMaterial::class, 'raw_material_id');
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitPacking::class, 'unit_id');
    }
}
