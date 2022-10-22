<?php

namespace App\Services\CollectionPayments\Interfaces;

use App\Models\CollectionPayment;
use App\Services\CollectionPayments\Resources\CreateCollectionPaymentResource;

interface CollectionPaymentFactoryInterface
{
    public function make(CreateCollectionPaymentResource $resource): CollectionPayment;
}
