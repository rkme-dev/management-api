<?php

declare(strict_types=1);

namespace App\Jobs\Reports;

use App\Services\InventoryService\Interfaces\StockcardFactoryInterface;
use App\Services\InventoryService\Resources\CreateStockcardResource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class CreateStockcardReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public CreateStockcardResource $resource
    ) {
    }

    public function handle(
        StockcardFactoryInterface $stockcardFactory
    ): void {
        $stockcardFactory->make($this->resource);
    }
}
