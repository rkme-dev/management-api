<?php

namespace App\Providers;

use App\Services\InventoryService\Interfaces\ProductItemCountResolverInterface;
use App\Services\InventoryService\Interfaces\StockcardFactoryInterface;
use App\Services\InventoryService\Resolvers\ProductItemCountResolver;
use App\Services\InventoryService\Resolvers\StockcardFactory;
use App\Services\ModuleNumber\Interfaces\ModuleNumberResolverInterface;
use App\Services\ModuleNumber\Resolvers\ModuleNumberResolver;
use App\Services\Processors\Stack;
use App\Services\PurchaseOrder\Processors\Interfaces\PurchaseOrderProcessorInterface;
use App\Services\PurchaseOrder\Processors\Middleware\ApprovePendingPurchaseOrderMiddleware;
use App\Services\PurchaseOrder\Processors\PurchaseOrderProcessor;
use Illuminate\Database\Events\MigrationsStarted;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $services = [
            ModuleNumberResolverInterface::class => ModuleNumberResolver::class,
            ProductItemCountResolverInterface::class => ProductItemCountResolver::class,
            StockcardFactoryInterface::class => StockcardFactory::class,
        ];

        foreach ($services as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }

        $this->app->bind(
            PurchaseOrderProcessorInterface::class,
            static function (Application $app): PurchaseOrderProcessor {
                $purchaseOrderStack = new Stack([
                    $app->make(ApprovePendingPurchaseOrderMiddleware::class),
                ]);

                return new PurchaseOrderProcessor($purchaseOrderStack);
            }
        );

        Event::listen(MigrationsStarted::class, function () {
            if ( env('APP_ENV') === 'development' ) {
                DB::statement('SET SESSION sql_require_primary_key=0');
            }
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
