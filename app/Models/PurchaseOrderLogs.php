<?php

namespace App\Models;

use App\Models\Traits\HasRelationshipWithUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class PurchaseOrderLogs extends Model
{
    use HasFactory, HasRelationshipWithUser;

    protected $fillable = [
        'message',
        'status',
        'user_id',
        'order_id',
        'action',
    ];

    public function purchaseOrder(): BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
