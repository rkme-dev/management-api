<?php

declare(strict_types=1);

namespace App\Jobs\StockRequestProduceItems;

use App\Models\StockRequestItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class StockRequestItemJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected int $stockRequestId,
        protected string $totalPieces,
        protected int $rawMaterialId,
        protected ?int $unitId = null,
        protected ?string $quantityOfUnit = null,
    ) {
    }

    public function handle(): void
    {
        StockRequestItem::create([
            'stock_request_id' => $this->stockRequestId,
            'quantity_of_unit' => $this->quantityOfUnit,
            'total_pieces' => $this->totalPieces,
            'unit_id' => $this->unitId,
            'raw_material_id' => $this->rawMaterialId,
        ]);
    }
}
