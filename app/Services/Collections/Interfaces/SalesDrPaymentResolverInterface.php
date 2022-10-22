<?php

declare(strict_types=1);

namespace App\Services\Collections\Interfaces;

use App\Models\SalesDrPayment;

interface SalesDrPaymentResolverInterface
{
    public function resolve(SalesDrPayment $salesDrPayment): void;
}
