<?php

declare(strict_types=1);

namespace App\Services\CollectionPayments\Factories;

use App\Enums\PaymentTypesEnum;
use App\Services\CollectionPayments\Interfaces\CollectionTypeFactoryResolverInterface;
use App\Services\CollectionPayments\Interfaces\PaymentTypeFactoryInterface;
use App\Services\Utils\CollectorHelper;

final class CollectionTypeFactoryResolver implements CollectionTypeFactoryResolverInterface
{
    /**
     * @var PaymentTypeFactoryInterface[]
     */
    private array $drivers;

    public function __construct(iterable $drivers)
    {
        $this->drivers = CollectorHelper::filterByClassAsArray(
            $drivers,
            PaymentTypeFactoryInterface::class
        );
    }

    /**
     * @throws \Exception
     */
    public function resolve(PaymentTypesEnum $enum): PaymentTypeFactoryInterface
    {
        foreach ($this->drivers as $driver) {
            if ($driver->supports($enum) === true) {
                return $driver;
            }
        }

        throw new \Exception('Invalid Payment Type Driver.');
    }
}
