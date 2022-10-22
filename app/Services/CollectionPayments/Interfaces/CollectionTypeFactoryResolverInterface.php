<?php

namespace App\Services\CollectionPayments\Interfaces;

use App\Enums\PaymentTypesEnum;

interface CollectionTypeFactoryResolverInterface
{
    public function resolve(PaymentTypesEnum $enum): PaymentTypeFactoryInterface;
}
