<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'bank_name',
        'bank_account_no',
        'active',
        'address',
        'contact_person',
        'name',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_supplier',
            'supplier_id',
            'product_id',
        );
    }
}
