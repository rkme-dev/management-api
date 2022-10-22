<?php

namespace App\Services\CollectionPayments\Interfaces;

use App\Enums\PaymentTypesEnum;
use App\Models\CollectionPaymentTypes\PaymentTypeInterface;
use App\Services\CollectionPayments\Resources\CreatePaymentTypeResource;

interface PaymentTypeFactoryInterface
{
    public function make(CreatePaymentTypeResource $resource): PaymentTypeInterface;

    public function supports(PaymentTypesEnum $enum): bool;
}
