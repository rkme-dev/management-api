<?php

namespace App\Models;

use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

final class Salesman extends Model implements AuditableInterface
{
    use HasFactory, HasRelationshipWithUser, SoftDeletes, Auditable;

    protected $casts = [
      'is_active' => 'boolean',
    ];

    protected $fillable = [
        'quota',
        'is_active',
        'salesman_code',
        'salesman_name',
        'notes',
        'created_by',
        'updated_by',
    ];

    protected $table = 'salesman_file';
}
