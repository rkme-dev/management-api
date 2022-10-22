<?php

declare(strict_types=1);

namespace App\Services\Collections\Resolvers;

use App\Models\SalesDr;
use App\Models\SalesDrPayment;
use App\Services\Collections\Interfaces\SalesDrPaymentResolverInterface;

final class SalesDrPaymentResolver implements SalesDrPaymentResolverInterface
{
    public function resolve(SalesDrPayment $salesDrPayment): void
    {
        $amountToPay = $salesDrPayment->getAttribute('amount_to_pay');

        /** @var SalesDr $salesDr */
        $salesDr = $salesDrPayment->salesDr;

        // Sales DR - deduct the remaining balance amount from payment
        $salesDrRemainingBalance = $salesDr->getAttribute('remaining_balance');

        if ($salesDrRemainingBalance === 0) {
            return;
        }

        $salesDrRemainingBalance = (float) $salesDrRemainingBalance - (float) $amountToPay;
        $salesDr->setAttribute('remaining_balance', $salesDrRemainingBalance);
        $salesDr->save();

        // Sales Dr Payment - tag as applied
        $salesDrPayment->setAttribute('is_applied', 1);
        $salesDrPayment->save();
    }
}
