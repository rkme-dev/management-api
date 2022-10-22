<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\CollectionPayments\Factories\CashPaymentFactory;
use App\Services\CollectionPayments\Factories\CheckPaymentFactory;
use App\Services\CollectionPayments\Factories\CollectionPaymentFactory;
use App\Services\CollectionPayments\Factories\CollectionTypeFactoryResolver;
use App\Services\CollectionPayments\Factories\OnlinePaymentFactory;
use App\Services\CollectionPayments\Interfaces\CollectionPaymentFactoryInterface;
use App\Services\CollectionPayments\Interfaces\CollectionTypeFactoryResolverInterface;
use App\Services\CollectionPayments\Interfaces\PaymentTypeFactoryInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

final class CollectionPaymentTypeServiceProvider extends ServiceProvider
{
    /**
     * Register the application factories as services.
     */
    public function register(): void
    {
        $services = [
            CollectionPaymentFactoryInterface::class => CollectionPaymentFactory::class,
        ];

        foreach ($services as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }

        $this->app->tag(
            [
                CashPaymentFactory::class,
                CheckPaymentFactory::class,
                OnlinePaymentFactory::class,
            ],
            PaymentTypeFactoryInterface::class
        );

        $this->app->bind(CollectionTypeFactoryResolverInterface::class,
            static function (Application $app) {
                return new CollectionTypeFactoryResolver($app->tagged(PaymentTypeFactoryInterface::class));
            }
        );
    }
}
