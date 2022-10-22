<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Collections;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnPostCollectionController extends AbstractAPIController
{
    /**
     * @throws \Exception
     */
    public function __invoke(int $id): JsonResource
    {
        $collection = Collection::where('id', $id)->first();

        $collection->update([
            'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
            'updated_by' => $this->getUser()->getId(),
        ]);

        $collection->refresh();

        return new JsonResource($collection);
    }
}
