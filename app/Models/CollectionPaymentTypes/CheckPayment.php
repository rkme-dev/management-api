<?php

namespace App\Models\CollectionPaymentTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class CheckPayment extends Model implements PaymentTypeInterface
{
    use HasFactory;

    protected $fillable = [
        'bank',
        'bank_account_number',
        'check_type',
        'check_number',
    ];

    protected $table = 'check_payments';
}
