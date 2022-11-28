<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Carbon\Carbon;

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
        'departed_at',
    ];

    protected $table = 'trip_tickets';

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'sales_dr',
        'departed_date',
        'departed_time'
    ];

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

    /**
     * Format departed_at into date
     */
    public function getDepartedDateAttribute()
    {
        return Carbon::parse($this->departed_at)->format('Y-m-d');
    }

    /**
     * Format departed_at into time
     */
    public function getDepartedTimeAttribute()
    {
        return Carbon::parse($this->departed_at)->format('H:i:s');
    }

    public function getSalesDrAttribute()
    {
        return $salesDrItems = $this->sales_dr_items;
        $response = [];

        foreach($salesDrItems as $salesDrItem) {
            $response[] = $salesDrItem->sales_dr;
        }
        return $response;
    }
}
