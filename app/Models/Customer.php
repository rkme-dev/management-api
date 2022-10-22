<?php

namespace App\Models;

use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Customer extends Model
{
    use HasFactory, SoftDeletes, HasRelationshipWithUser;

    protected $fillable = [
        'code',
        'name',
        'address',
        'delivery_address',
        'email',
        'contact_person',
        'contact_no',
        'tin',
        'credit_limit',
        'is_active',
        'is_bad_account',
        'salesman_id_1',
        'salesman_id_2',
        'area',
        'term_id',
        'vat_id',
        'type',
        'notes',
        'created_by',
        'updated_by',
    ];

    public function salesOrders(): HasMany
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function collections(): HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
