<?php

namespace App\Models;

use App\Enums\ReleaseOrderStatusesEnum;
use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

final class ReleaseOrder extends Model
{
    use HasFactory, SoftDeletes, HasRelationshipWithUser;

    protected $casts = [
        'status' => ReleaseOrderStatusesEnum::class,
    ];

    protected $fillable = [
        'status',
        'released_by',
        'received_by',
        'updated_by',
        'created_by',
    ];

    protected $table = 'release_orders';

    public function getProductReleaseOrders(): Collection
    {
        return $this->productReleaseOrders;
    }

    public function productReleaseOrders(): HasMany
    {
        return $this->hasMany(ProductReleaseOrder::class);
    }

    public function receivedBy(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function releasedBy(): ?BelongsTo
    {
        return $this->belongsTo(User::class, 'released_by');
    }

    public function orderItems(): MorphOne
    {
        return $this->morphOne(OrderItem::class, 'orderable');
    }
}
