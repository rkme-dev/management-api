<?php

declare(strict_types=1);

namespace App\Services\CollectionPayments\Factories;

use App\Enums\PaymentTypesEnum;
use App\Models\CollectionPaymentTypes\CheckPayment;
use App\Models\CollectionPaymentTypes\PaymentTypeInterface;
use App\Services\CollectionPayments\Interfaces\PaymentTypeFactoryInterface;
use App\Services\CollectionPayments\Resources\CreatePaymentTypeResource;

final class CheckPaymentFactory implements PaymentTypeFactoryInterface
{
    public function make(CreatePaymentTypeResource $resource): PaymentTypeInterface
    {
        return CheckPayment::create([
            'bank' => $resource->getBank(),
            'bank_account_number' => $resource->getBankAccountNumber(),
            'check_type' => $resource->getCheckType(),
            'check_number' => $resource->getCheckNumber(),
        ]);
    }

    public function supports(PaymentTypesEnum $enum): bool
    {
        return $enum === PaymentTypesEnum::CHECK_PAYMENT;
    }
}
