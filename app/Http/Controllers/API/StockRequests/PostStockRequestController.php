<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockRequests;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\StockRequest;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostStockRequestController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var StockRequest $stockRequest */
        $stockRequest = StockRequest::where('id', $id)->first();

        if ($stockRequest === null) {
            return $this->respondNotFound('Stock Request not found.');
        }

        $stockRequest->setAttribute('status', SaleOrderStatusesEnum::POSTED);
        $stockRequest->save();

        return new JsonResource($stockRequest);
    }
}
