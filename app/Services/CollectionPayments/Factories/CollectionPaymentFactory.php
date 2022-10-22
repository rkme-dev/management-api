<?php

declare(strict_types=1);

namespace App\Services\CollectionPayments\Factories;

use App\Models\CollectionPayment;
use App\Services\CollectionPayments\Resources\CreateCollectionPaymentResource;
use App\Services\CollectionPayments\Interfaces\CollectionPaymentFactoryInterface;

final class CollectionPaymentFactory implements CollectionPaymentFactoryInterface
{
    public function make(CreateCollectionPaymentResource $resource): CollectionPayment
    {
        return CollectionPayment::create([
            'collection_id' => $resource->getCollection()->getAttribute('id'),
            'account_id' => $resource->getAccountId(),
            'payment_type' => $resource->getType()::class,
            'payment_id' => $resource->getType()->getAttribute('id'),
            'payment_date' => $resource->getPaymentDate(),
            'amount' => $resource->getAmount(),
            'created_by' => $resource->getCreatedBy()->getAttribute('id'),
        ]);
    }
}
