<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UnitPacking extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'pieces_per_unit',
        'created_by',
        'is_active',
    ];

    protected $table = 'unit_packings';

    public function product(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
