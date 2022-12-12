<?php

declare(strict_types=1);

namespace App\Services\PurchaseOrder\Processors\Middleware;

use App\Services\Processors\Interfaces\MiddlewareInterface;
use App\Services\Processors\Interfaces\StackInterface;
use App\Services\PurchaseOrder\Processors\Interfaces\OrderContextInterface;

class ApprovePendingPurchaseOrderMiddleware implements MiddlewareInterface
{
    public function process(OrderContextInterface $orderContext, StackInterface $stack): OrderContextInterface
    {
        //$orderContext
    }
}
