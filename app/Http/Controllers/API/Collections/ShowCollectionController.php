<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Collections;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowCollectionController extends AbstractAPIController
{
    /**
     * @throws \Exception
     */
    public function __invoke(int $id): JsonResource
    {
        $collection = Collection::where('id', $id)
            ->with([
                'orderItems',
                'salesDrPayments',
                'payments',
                'customer',
                'document',
            ])
            ->first();

        return new JsonResource($collection);
    }
}
