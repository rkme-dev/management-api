<?php

namespace App\Providers;

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
