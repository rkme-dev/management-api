<?php

declare(strict_types=1);

namespace App\Providers;

use App\Services\Collections\Interfaces\CollectionPostedResolverInterface;
use App\Services\Collections\Interfaces\CollectionUnpostResolverInterface;
use App\Services\Collections\Interfaces\SalesDrPaymentResolverInterface;
use App\Services\Collections\Resolvers\CollectionPostedResolver;
use App\Services\Collections\Resolvers\CollectionUnpostResolver;
use App\Services\Collections\Resolvers\SalesDrPaymentResolver;
use Illuminate\Support\ServiceProvider;

final class CollectionServiceProvider extends ServiceProvider
{
    /**
     * Register the application factories as services.
     */
    public function register(): void
    {
        $services = [
            CollectionPostedResolverInterface::class => CollectionPostedResolver::class,
            SalesDrPaymentResolverInterface::class => SalesDrPaymentResolver::class,
            CollectionUnpostResolverInterface::class => CollectionUnpostResolver::class,
        ];

        foreach ($services as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }
}
