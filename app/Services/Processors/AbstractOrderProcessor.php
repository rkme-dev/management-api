<?php

declare(strict_types=1);

namespace App\Services\Processors;

use App\Services\Processors\Interfaces\StackInterface;
use App\Services\PurchaseOrder\Processors\Interfaces\OrderContextInterface;

abstract class AbstractOrderProcessor
{
    private $stack;

    public function __construct(StackInterface $stack)
    {
        $this->stack = $stack;
    }

    public function process(OrderContextInterface $orderContext): OrderContextInterface
    {
        return $this->stack->next($orderContext);
    }
}
