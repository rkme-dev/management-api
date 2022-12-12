<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class StockRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'date',
        'process_type',
        'remarks',
        'status',
        'document_id',
        'location_id',
        'created_by',
        'updated_by',
        'posted_by',
    ];

    protected $table = 'stock_requests';

    public function stockRequestItems(): HasMany
    {
        return $this->hasMany(StockRequestItem::class, 'stock_request_id');
    }

    public function stockRequestProduceItems(): HasMany
    {
        return $this->hasMany(StockRequestProduceItem::class, 'stock_request_id');
    }

    public function stockRelease(): BelongsTo
    {
        return $this->belongsTo(StockRelease::class, 'stock_release_id');
    }

    public function document(): BelongsTo
    {
        return $this->belongsTo(Document::class);
    }

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function postedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
