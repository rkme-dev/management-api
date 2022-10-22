<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;

final class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_id',
        'barcode',
        'container_number',
        'courier_name',
        'courier_number',
        'description',
        'number',
        'active',
        'total',
        'total_amount_payable',
        'subtotal',
        'paid_at',
        'paid_amount',
        'refunded_at',
        'invoice_id',
        'status',
        'fx_id',
        'eta',
        'payment_method',
        'arrived_at',
    ];

    public function orderItems(): MorphMany
    {
        return $this->morphMany(OrderItem::class, 'orderable');
    }

    public function paymentLogs(): MorphMany
    {
        return $this->morphMany(PaymentLogs::class, 'orderable');
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchaseOrderLogs(): HasMany {
        return $this->hasMany(PurchaseOrderLogs::class);
    }
}
