<?php

namespace App\Models;

use App\Enums\DepartmentStatusesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Silber\Bouncer\Database\HasRolesAndAbilities;

final class AccessLevel extends Model
{
    use HasFactory, HasRolesAndAbilities, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'updated_by',
        'created_by',
    ];

    protected $casts = [
        'status' => DepartmentStatusesEnum::class,
    ];
}
