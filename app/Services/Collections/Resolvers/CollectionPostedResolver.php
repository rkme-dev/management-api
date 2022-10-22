<?php

declare(strict_types=1);

namespace App\Services\Collections\Resolvers;

use App\Models\Collection;
use App\Jobs\Collection\SalesDrPaymentPostingJob;
use App\Services\Collections\Interfaces\CollectionPostedResolverInterface;

final class CollectionPostedResolver implements CollectionPostedResolverInterface
{
    public function resolve(Collection $collection): void
    {
        $salesDrPayments = $collection->salesDrPayments;

        foreach ($salesDrPayments as $salesDrPayment) {
            SalesDrPaymentPostingJob::dispatch($salesDrPayment->getAttribute('id'));
        }
    }
}
