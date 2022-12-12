<?php

declare(strict_types=1);

namespace App\Jobs\Collection;

use App\Services\InventoryService\Interfaces\ProductItemCountResolverInterface;
use App\Services\InventoryService\Resources\ProductItemCountResource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class ProductInitializeInventoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $productId;

    private string $unit;

    private string $quantity;

    public function __construct(
        int $productId,
        string $unit,
        string $quantity
    ) {
        $this->productId = $productId;
        $this->unit = $unit;
        $this->quantity = $quantity;
    }

    public function handle(
        ProductItemCountResolverInterface $productItemCountResolver
    ): void {
        $productItemCountResolver->resolve(new ProductItemCountResource([
            'productId' => $this->productId,
            'unit' => $this->unit,
            'quantity' => $this->quantity,
        ]));
    }
}
