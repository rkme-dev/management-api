<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Collection;

class PhysicalCount extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $guarded = [];

    public function getItems(): Collection
    {
        return $this->countItems;
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

    public function countItems(): HasMany
    {
        return $this->hasMany(CountItem::class);
    }
}
