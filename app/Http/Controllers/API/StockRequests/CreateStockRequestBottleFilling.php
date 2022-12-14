<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockRequests;

use App\Enums\ProductionTypesEnum;
use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\StockRequests\CreateStockRequestRequest;
use App\Jobs\StockRequestProduceItems\StockRequestItemJob;
use App\Jobs\StockRequestProduceItems\StockRequestProduceItemJob;
use App\Models\StockRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class CreateStockRequestBottleFilling extends AbstractAPIController
{
    public function __invoke(CreateStockRequestRequest $request): JsonResource
    {
        $stockRequest = StockRequest::create([
            ...$request->only([
                'remarks',
                'document_id',
                'location_id',
            ]),
            ...[
                'process_type' => ProductionTypesEnum::BOTTLE_FILLING,
                'date' => $this->generateDateTime($request->get('date')),
                'code' => $this->generateNumber('stock_requests', 'S-REQUEST', 'code'),
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        $this->createStockRequestItemToProduce($stockRequest, $request->get('items_to_produce'));

        $this->createStockRequestItems($stockRequest, $request->get('stock_items'));

        return new JsonResource($stockRequest);
    }

    private function createStockRequestItemToProduce(StockRequest $stockRequest, array $items): void
    {
        if (count($items) === 0) {
            return;
        }

        foreach ($items as $item) {
            StockRequestProduceItemJob::dispatch(
                $stockRequest->getAttribute('id'),
                Arr::get($item, 'quantity_of_unit'),
                Arr::get($item, 'total_pieces'),
                Arr::get($item, 'unit_id'),
                Arr::get($item, 'product_id')
            );
        }
    }

    private function createStockRequestItems(StockRequest $stockRequest, array $items): void
    {
        if (count($items) === 0) {
            return;
        }

        foreach ($items as $item) {
            StockRequestItemJob::dispatch(
                $stockRequest->getAttribute('id'),
                Arr::get($item, 'total_pieces'),
                Arr::get($item, 'raw_material_id'),
                Arr::get($item, 'unit_id'),
                Arr::get($item, 'quantity_of_unit'),
            );
        }
    }
}
