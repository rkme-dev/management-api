<?php

namespace App\Models;

use App\Enums\DepartmentStatusesEnum;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Silber\Bouncer\Database\HasRolesAndAbilities;

final class Department extends Model
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

    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }
}
