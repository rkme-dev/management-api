<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class PaymentLogs extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'amount',
        'orderable_type',
        'orderable_id',
        'total',
        'status',
        'user_id',
        'fx_id',
        'dp_percentage',
        'peso_conversion',
        'conversion_rate',
        'usd_conversion',
        'paid_to',
        'type',
    ];

    public function purchaseOrders()
    {
        return $this->morphMany(PurchaseOrder::class, 'orderable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
