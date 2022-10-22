<?php

namespace App\Models;

use App\Enums\ProductionProcedureTypesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

final class Line extends Model
{
    use HasFactory, SoftDeletes;

    protected $casts = [
        'procedure_type' => ProductionProcedureTypesEnum::class,
    ];

    protected $fillable = [
        'name',
        'description',
        'procedure_type',
        'created_by',
    ];
}
