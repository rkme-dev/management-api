<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\StockReleases;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\StockRelease;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostStockReleaseController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var StockRelease $stockRelease */
        $stockRelease = StockRelease::where('id', $id)->first();

        if ($stockRelease === null) {
            return $this->respondNotFound('Stock Release not found.');
        }

        $stockRelease->setAttribute('status', SaleOrderStatusesEnum::POSTED);
        $stockRelease->save();

        return new JsonResource($stockRelease);
    }
}
