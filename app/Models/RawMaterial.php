<?php

namespace App\Models;

use App\Enums\RawMaterialTypeEnums;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class RawMaterial extends Model
{
    use HasFactory;

    protected $casts = [
        'type' => RawMaterialTypeEnums::class,
    ];

    protected $fillable = [
        'active',
        'name',
        'sku',
        'slug',
        'type',
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
            'raw_material_unit_packing',
            'raw_material_id',
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
            'raw_material_supplier',
            'raw_material_id',
            'supplier_id',
        );
    }
}
