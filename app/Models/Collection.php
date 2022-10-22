<?php

namespace App\Models;

use App\Enums\SaleOrderStatusesEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

class Collection extends Model implements AuditableInterface
{
    use HasFactory, Auditable;

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
        'address',
        'amount',
        'status',
        'date_posted',
        'collection_order_number',
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

    protected $table = 'collections';

    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }

    public function salesDrPayments(): HasMany
    {
        return $this->hasMany(SalesDrPayment::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(CollectionPayment::class);
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
