<?php

namespace App\Models;

use App\Enums\WarehouseStatusesEnum;
use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Warehouse extends Model
{
    use HasFactory, SoftDeletes, HasRelationshipWithUser;

    protected $casts = [
        'is_main' => 'boolean',
        'status' => WarehouseStatusesEnum::class,
    ];

    protected $fillable = [
        'name',
        'status',
        'address',
        'contact_number',
        'is_main',
        'created_by',
    ];

    public $table = 'warehouses';
}
