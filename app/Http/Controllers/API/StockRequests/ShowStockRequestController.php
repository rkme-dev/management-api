<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockRequests;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\StockRequests\UpdateStockRequestRequest;
use App\Models\StockRequest;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowStockRequestController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var StockRequest $stockRequest */
        $stockRequest = StockRequest::where('id', $id)->first();

        if ($stockRequest === null) {
            return $this->respondNotFound('Stock Request not found.');
        }

        return new JsonResource($stockRequest);
    }
}
