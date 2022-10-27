<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class CollectionPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'collection_id',
        'account_id',
        'payment_type',
        'payment_id',
        'payment_date',
        'amount',
        'created_by',
    ];

    protected $table = 'collection_payments';

    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function collection(): BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function payment(): MorphTo
    {
        return $this->morphTo();
    }
}
