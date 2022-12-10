<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockReleases;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\StockRelease;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListStockReleaseController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        $stockReleases = StockRelease::with([
            'stockRequests.stockRequestItems.rawMaterial',
            'stockRequests.stockRequestItems.unit',
            'stockRequests.stockRequestProduceItems.product',
            'stockRequests.stockRequestProduceItems.unit',
            'document',
            'location',
            'createdBy',
            'updatedBy',
            'postedBy',
        ])->get();

        return new JsonResource($stockReleases);
    }
}
