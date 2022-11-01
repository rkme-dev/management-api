<?php

declare(strict_types=1);

namespace App\Services\Collections\Resolvers;

use App\Models\Collection;
use App\Models\SalesDrPayment;
use App\Services\Collections\Interfaces\CollectionUnpostResolverInterface;

final class CollectionUnpostResolver implements CollectionUnpostResolverInterface
{
    public function resolve(Collection $collection): void
    {
        $salesDrPayments = $collection->salesDrPayments;

        $amount = 0.00;

        /** @var SalesDrPayment $salesDrPayment */
        foreach ($salesDrPayments as $salesDrPayment) {
            $amount += (float) $salesDrPayment->getAttribute('amount_to_pay');
        }

        $remainingBalance = (float) $salesDrPayment->getSalesDr()->getAttribute('remaining_balance');

        $remainingBalance = $remainingBalance + $amount;

        $salesDrPayment->getSalesDr()->setAttribute('remaining_balance', $remainingBalance);
    }
}
