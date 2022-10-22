<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;
use Silber\Bouncer\Database\HasRolesAndAbilities;

final class User extends Authenticatable implements AuditableInterface
{
    use HasApiTokens, HasFactory, HasRolesAndAbilities, Notifiable, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'employment_type',
        'department_id',
        'access_level_id',
        'gender',
        'designation',
        'profile_url',
        'valid_id_url',
        'pagibig',
        'tin',
        'sss',
        'emergency_contact_address',
        'emergency_contact_name',
        'emergency_contact_number',
        'birth_date',
        'date_hired',
        'email',
        'password',
        'status',
        'is_active',
        'number',
    ];

    public function getFullName(): string
    {
        return \sprintf(
            '%s %s %s',
            $this->first_name,
            $this->middle_name,
            $this->last_name,
        );
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getId()
    {
        return $this->id;
    }

    public function purchaseOrderLogs(): HasMany
    {
        return $this->hasMany(PurchaseOrderLogs::class);
    }

    public function purchaseOrderPaymentLogs(): HasMany
    {
        return $this->hasMany(PaymentLogs::class);
    }
}
