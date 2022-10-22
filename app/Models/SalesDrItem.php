<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableInterface;

final class SalesDrItem extends Model implements AuditableInterface
{
    use HasFactory, Auditable;

    protected $fillable = [
        'is_linked',
        'sales_dr_id',
        'sales_order_item_id',
        'sales_dr_item_id',
        'trip_ticket_id'
    ];

    public function tripTicket(): BelongsTo
    {
        return $this->belongsTo(TripTicket::class);
    }

    public function salesDr(): BelongsTo
    {
        return $this->belongsTo(SalesDr::class);
    }

    public function salesOrderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'sales_order_item_id');
    }

    public function drOrderItem(): BelongsTo
    {
        return $this->belongsTo(OrderItem::class, 'sales_dr_item_id');
    }

    protected $table = 'sales_dr_items';
}
