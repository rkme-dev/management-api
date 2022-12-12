<?php

declare(strict_types=1);

namespace App\Jobs\StockRequestProduceItems;

use App\Models\StockRequestProduceItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class StockRequestProduceItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected int $stockRequestId,
        protected string $quantityOfUnit,
        protected string $totalPieces,
        protected int $unitId,
        protected int $productId,
    ) {
    }

    public function handle(): void
    {
        StockRequestProduceItem::create([
            'stock_request_id' => $this->stockRequestId,
            'quantity_of_unit' => $this->quantityOfUnit,
            'total_pieces' => $this->totalPieces,
            'unit_id' => $this->unitId,
            'product_id' => $this->productId,
        ]);
    }
}
