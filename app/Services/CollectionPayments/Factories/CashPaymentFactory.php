<?php

declare(strict_types=1);

namespace App\Services\CollectionPayments\Factories;

use App\Enums\PaymentTypesEnum;
use App\Models\CollectionPayment;
use App\Models\CollectionPaymentTypes\CashPayment;
use App\Models\CollectionPaymentTypes\PaymentTypeInterface;
use App\Services\CollectionPayments\Interfaces\PaymentTypeFactoryInterface;
use App\Services\CollectionPayments\Resources\CreatePaymentTypeResource;

final class CashPaymentFactory implements PaymentTypeFactoryInterface
{
    public function make(CreatePaymentTypeResource $resource): PaymentTypeInterface
    {
        return CashPayment::create();
    }

    public function supports(PaymentTypesEnum $enum): bool
    {
        return $enum === PaymentTypesEnum::CASH_PAYMENT;
    }
}
