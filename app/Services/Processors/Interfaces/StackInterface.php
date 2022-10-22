<?php

declare(strict_types=1);

namespace App\Services\Processors\Interfaces;

use App\Services\PurchaseOrder\Processors\Interfaces\OrderContextInterface;

interface StackInterface
{
    public function next(OrderContextInterface $orderContext): OrderContextInterface;
}
