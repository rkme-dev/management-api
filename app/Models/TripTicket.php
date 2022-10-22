<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

final class TripTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'trip_ticket_number',
        'date_posted',
        'area',
        'driver',
        'assistant',
        'truck',
        'plate_number',
        'document_id',
        'remarks',
        'created_by',
    ];

    protected $table = 'trip_tickets';

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function salesDrItems(): HasMany
    {
        return $this->hasMany(SalesDrItem::class);
    }

    public function orderItems(): HasManyThrough
    {
        return $this->hasManyThrough(
            OrderItem::class,
            SalesDrItem::class,
            'trip_ticket_id',
            'id',
            'id',
            'sales_dr_item_id',
        );
    }
}
