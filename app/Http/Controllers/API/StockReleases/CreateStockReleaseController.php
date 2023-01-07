<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockReleases;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\StockReleases\CreateStockReleaseRequest;
use App\Models\StockRelease;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateStockReleaseController extends AbstractAPIController
{
    public function __invoke(CreateStockReleaseRequest $request): JsonResource
    {
        /** @var StockRelease $stockRelease */
        $stockRelease = StockRelease::create([
            ...$request->only([
                'process_type',
                'remarks',
                'status',
                'document_id',
                'location_id',
            ]),
            ...[
                'date' => $this->generateDateTime($request->get('date')),
                'code' => $this->generateNumber(
                    'stock_releases',
                    'S-RELEASE',
                    'code',
                ),
                'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
                'created_by' => $this->getUser()->getId(),
            ],
        ]);

        $stockRelease->setStockRequest($request->get('stock_requests'));

        return new JsonResource($stockRelease);
    }
}
