<?php

namespace App\Models\CollectionPaymentTypes;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class CashPayment extends Model implements PaymentTypeInterface
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'cash_payments';
}
