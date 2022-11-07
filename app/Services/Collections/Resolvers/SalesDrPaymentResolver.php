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
        $amountToPay = (float) $salesDrPayment->getAttribute('amount_to_pay');

        /** @var SalesDr $salesDr */
        $salesDr = $salesDrPayment->salesDr;

        $salesDr->refresh();

        // Sales DR - deduct the remaining balance amount from payment
        $salesDrRemainingBalance = (float) $salesDr->getAttribute('remaining_balance');

        if ($salesDrRemainingBalance === 0.00) {
            return;
        }

        // Sales Dr Payment - tag as applied
        $salesDrPayment->setAttribute('is_applied', 1);
        $salesDrPayment->save();

        if ($salesDrRemainingBalance < $amountToPay) {
            $salesDr->setAttribute('remaining_balance', 0);
            $salesDr->save();

            return;
        }

        $salesDrRemainingBalance = $salesDrRemainingBalance - $amountToPay;
        $salesDr->setAttribute('remaining_balance', $salesDrRemainingBalance);
        $salesDr->save();
    }
}
