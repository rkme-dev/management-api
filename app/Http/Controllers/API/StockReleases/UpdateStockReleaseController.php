<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockReleases;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\StockReleases\UpdateStockReleaseRequest;
use App\Models\StockRelease;
use Illuminate\Http\Resources\Json\JsonResource;

final class UpdateStockReleaseController extends AbstractAPIController
{
    public function __invoke(UpdateStockReleaseRequest $request, int $id): JsonResource
    {
        /** @var StockRelease $stockRelease */
        $stockRelease = StockRelease::where('id', $id)->first();

        if ($stockRelease === null) {
            return $this->respondNotFound('Stock Release not found.');
        }

        $updates = [
            ...$request->only([
                'process_type',
                'remarks',
                'document_id',
                'location_id',
            ]),
            ...[
                'date' => $this->generateDateTime($request->get('date')),
                'updated_by' => $this->getUser()->getId(),
            ],
        ];

        $stockRelease->update($updates);

        $stockRelease->setStockRequest($request->get('stock_requests'));

        return new JsonResource($stockRelease);
    }
}
