<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockRequests;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\StockRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListStockRequestController extends AbstractAPIController
{
    public function __invoke(Request $request): JsonResource
    {

        $type = $request->get('type') ?? null;

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
        ])->when($type, function ($query) use ($type) {
            $query->where('process_type', $type);
        })
            ->get();

        return new JsonResource($stockRequests);
    }
}
