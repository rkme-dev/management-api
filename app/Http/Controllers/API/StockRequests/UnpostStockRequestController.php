<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockRequests;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\StockRequest;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnpostStockRequestController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var StockRequest $stockRequest */
        $stockRequest = StockRequest::where('id', $id)->first();

        if ($stockRequest === null) {
            return $this->respondNotFound('Stock Request not found.');
        }

        $stockRequest->setAttribute('posted_by', null);
        $stockRequest->setAttribute('status', SaleOrderStatusesEnum::FOR_REVIEW);
        $stockRequest->save();

        return new JsonResource($stockRequest);
    }
}
