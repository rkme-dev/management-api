<?php

namespace App\Models\CollectionPaymentTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class OnlinePayment extends Model implements PaymentTypeInterface
{
    use HasFactory;

    protected $fillable = [
        'mode_of_transfer',
        'transaction_number',
    ];

    protected $table = 'online_payments';
}
