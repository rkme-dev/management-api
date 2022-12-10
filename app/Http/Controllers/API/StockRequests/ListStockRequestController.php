<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockRequests;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\StockRequest;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListStockRequestController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $stockRequests = StockRequest::with([
            'stockRequestItems.rawMaterial',
            'stockRequestItems.unit',
            'stockRequestProduceItems.product',
            'stockRequestProduceItems.unit',
            'document',
            'location',
            'createdBy',
            'updatedBy',
            'postedBy',
        ])->get();

        return new JsonResource($stockRequests);
    }
}
