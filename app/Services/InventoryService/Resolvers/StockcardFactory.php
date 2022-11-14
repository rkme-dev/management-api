<?php

declare(strict_types=1);

namespace App\Services\InventoryService\Resolvers;

use App\Models\StockcardReport;
use App\Services\InventoryService\Interfaces\StockcardFactoryInterface;
use App\Services\InventoryService\Resources\CreateStockcardResource;

final class StockcardFactory implements StockcardFactoryInterface
{
    public function make(CreateStockcardResource $resource): StockcardReport
    {
        return StockcardReport::create([
            'morphable_type' => $resource->getType(),
            'morphable_id' => $resource->getTypeId(),
            'product_id' => $resource->getProductId(),
            'date' => $resource->getDate(),
            'event' => $resource->getEvent(),
            'document' => $resource->getDocument(),
            'document_number' => $resource->getDocumentNumber(),
            'remarks' => $resource->getRemarks(),
            'quantity' => $resource->getQuantity(),
            'unit' => $resource->getUnit(),
            'price' => $resource->getPrice(),
            'status' => $resource->getStatus(),
            'quantity_in' => $resource->getQuantityIn(),
            'quantity_out' => $resource->getQuantityOut(),
            'balance' => $resource->getBalance(),
        ]);
    }
}
