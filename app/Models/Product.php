<?php

namespace App\Models;

use App\Enums\ProductTypeEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => ProductTypeEnums::class,
    ];

    protected $fillable = [
        'active',
        'name',
        'sku',
        'description',
        'slug',
        'type',
        'raw_material_type',
        'price',
        'brand',
        'group',
        'unit_id',
        'created_by',
    ];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(UnitPacking::class);
    }

    public function units(): BelongsToMany
    {
        return $this->belongsToMany(
            UnitPacking::class,
            'product_unit_packing',
            'product_id',
            'unit_packing_id',
        )->withPivot([
            'packing',
            'unit_packing_id',
            'actual_balance',
            'reserved_balance',
        ]);
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(
            Supplier::class,
            'product_supplier',
            'product_id',
            'supplier_id',
        );
    }
}
