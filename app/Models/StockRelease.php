<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class StockRelease extends Model
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

    protected $table = 'stock_releases';

    public function setStockRequest(array $ids): self
    {
        StockRequest::where('stock_release_id', $this->getAttribute('id'))->update([
            'stock_release_id' => null,
        ]);

        StockRequest::whereIn('id', $ids)->update([
            'stock_release_id' => $this->getAttribute('id'),
        ]);

        return $this;
    }

    public function stockRequests(): HasMany
    {
        return $this->hasMany(StockRequest::class);
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
