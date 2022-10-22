<?php

declare(strict_types=1);

namespace App\Services\Processors\Interfaces;

use App\Services\PurchaseOrder\Processors\Interfaces\OrderContextInterface;

interface MiddlewareInterface
{
    public function process(OrderContextInterface $orderContext, StackInterface $stack): OrderContextInterface;
}
