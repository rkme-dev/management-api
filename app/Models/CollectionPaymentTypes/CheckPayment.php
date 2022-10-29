<?php

namespace App\Models\CollectionPaymentTypes;

use App\Models\Collection;
use App\Models\CollectionPayment;
use App\Models\Deposit;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\MorphOne;

final class CheckPayment extends Model implements PaymentTypeInterface
{
    use HasFactory;

    protected $fillable = [
        'bank',
        'bank_account_number',
        'check_type',
        'check_number',
        'status',
        'deposit_id',
    ];

    protected $table = 'check_payments';

    public function collectionPayment(): MorphOne
    {
        return $this->morphOne(CollectionPayment::class, 'payment');
    }

    public function collection(): HasOneThrough
    {
        return $this->hasOneThrough(
            Collection::class,
            CollectionPayment::class,
            'payment_id',
            'id',
            'id',
            'payment_id',
        );
    }

    public function deposit(): BelongsTo
    {
        return $this->belongsTo(Deposit::class, 'deposit_id');
    }
}
