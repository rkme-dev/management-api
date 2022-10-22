<?php

declare(strict_types=1);

namespace App\Services\CollectionPayments\Factories;

use App\Enums\PaymentTypesEnum;
use App\Models\CollectionPaymentTypes\OnlinePayment;
use App\Models\CollectionPaymentTypes\PaymentTypeInterface;
use App\Services\CollectionPayments\Interfaces\PaymentTypeFactoryInterface;
use App\Services\CollectionPayments\Resources\CreatePaymentTypeResource;

final class OnlinePaymentFactory implements PaymentTypeFactoryInterface
{
    public function make(CreatePaymentTypeResource $resource): PaymentTypeInterface
    {
        return OnlinePayment::create([
            'mode_of_transfer' => $resource->getModeOfTransfer(),
            'transaction_number' => $resource->getTransactionNumber(),
        ]);
    }

    public function supports(PaymentTypesEnum $enum): bool
    {
        return $enum === PaymentTypesEnum::ONLINE_PAYMENT;
    }
}
