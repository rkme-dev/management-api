<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockRequests;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\StockRequests\CreateStockRequestRequest;
use App\Http\Requests\StockRequests\UpdateStockRequestRequest;
use App\Jobs\StockRequestProduceItems\StockRequestItemJob;
use App\Models\StockRequest;
use App\Models\StockRequestItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class UpdateStockRequestBottleBlowingController extends AbstractAPIController
{
    public function __invoke(UpdateStockRequestRequest $request, int $id): JsonResource
    {
        /** @var StockRequest $stockRequest */
        $stockRequest = StockRequest::where('id', $id)->first();

        if ($stockRequest === null) {
            return $this->respondNotFound('Stock Request not found.');
        }

        $updates = [
            ...$request->only([
                'remarks',
                'document_id',
                'location_id',
            ]),
            ...[
                'date' => $this->generateDateTime($request->get('date')),
                'updated_by' => $this->getUser()->getId(),
            ],
        ];

        $stockRequest->update($updates);
        $stockRequest->save();

        $this->createStockRequestItems($stockRequest, $request->get('stock_items'));

        return new JsonResource($stockRequest);
    }

    private function createStockRequestItems(StockRequest $stockRequest, array $items): void
    {
        if (count($items) === 0) {
            return;
        }

        StockRequestItem::where('stock_request_id', $stockRequest->getAttribute('id'))->delete();

        foreach ($items as $item) {
            StockRequestItemJob::dispatch(
                $stockRequest->getAttribute('id'),
                Arr::get($item, 'total_pieces'),
                Arr::get($item, 'raw_material_id')
            );
        }
    }
}
