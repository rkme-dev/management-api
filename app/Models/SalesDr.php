<?php

namespace App\Models;

use App\Enums\SaleOrderStatusesEnum;
use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

final class SalesDr extends Model implements AuditableInterface
{
    use HasFactory, HasRelationshipWithUser, SoftDeletes, Auditable;

    /**
     * @var string[]
     */
    protected $casts = [
        'status' => SaleOrderStatusesEnum::class,
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'sales_invoice_number',
        'promo_code',
        'address',
        'area',
        'is_linked',
        'amount',
        'remaining_balance',
        'status',
        'date_posted',
        'sales_dr_number',
        'remarks',
        'customer_id',
        'document_id',
        'salesman_id_1',
        'salesman_id_2',
        'term_id',
        'vat_id',
        'qr_code',
        'created_by',
        'updated_by',
    ];

    protected $table = 'sales_drs';

    public function payments(): HasMany
    {
        return $this->hasMany(SalesDrPayment::class);
    }

    public function salesDrItems(): HasMany
    {
        return $this->hasMany(SalesDrItem::class, 'sales_dr_id');
    }

    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function salesman1(): BelongsTo
    {
        return $this->belongsTo(Salesman::class, 'salesman_id_1');
    }

    public function salesman2(): BelongsTo
    {
        return $this->belongsTo(Salesman::class, 'salesman_id_2');
    }

    public function term(): BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public function vat(): BelongsTo
    {
        return $this->belongsTo(Vat::class);
    }
}
