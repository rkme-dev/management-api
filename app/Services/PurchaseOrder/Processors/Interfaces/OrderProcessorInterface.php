<?php

declare(strict_types=1);

namespace App\Services\PurchaseOrder\Processors\Interfaces;

interface OrderProcessorInterface
{
    public function process(OrderContextInterface $context): OrderContextInterface;
}
