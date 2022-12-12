<?php

declare(strict_types=1);

namespace App\Services\Processors;

use App\Services\Processors\Interfaces\MiddlewareInterface;
use App\Services\Processors\Interfaces\StackInterface;
use App\Services\PurchaseOrder\Processors\Interfaces\OrderContextInterface;
use App\Services\Utils\CollectorHelper;

class Stack implements MiddlewareInterface, StackInterface
{
    private int $index = 0;

    /**
     * @var MiddlewareInterface[]
     */
    private $middleware;

    public function __construct(iterable $middleware)
    {
        $this->middleware = CollectorHelper::ensureClassAsArray($middleware, MiddlewareInterface::class);
    }

    public function process(OrderContextInterface $orderContext, StackInterface $stack): OrderContextInterface
    {
        return $orderContext;
    }

    public function next(OrderContextInterface $orderContext): OrderContextInterface
    {
        $next = $this->middleware[$this->index] ?? null;

        // If there is no middleware left, return stack to "close the loop"
        if ($next === null) {
            return $orderContext;
        }

        // Increment index for next call
        $this->index++;

        return $next->process($orderContext, $this);
    }
}
