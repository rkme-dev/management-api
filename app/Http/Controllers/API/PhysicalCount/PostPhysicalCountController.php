<?php

namespace App\Http\Controllers\API\PhysicalCount;

use App\Enums\PhysicalCountStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Jobs\Collection\ProductInitializeInventoryJob;
use App\Models\PhysicalCount;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

final class PostPhysicalCountController extends AbstractAPIController
{
    public function __invoke(PhysicalCount $physicalCount): JsonResource
    {
        $physicalCount->load('countItems')
            ->update([
                'status' => PhysicalCountStatusesEnum::POSTED->value,
                'updated_by' => $this->getUser()->getId(),
            ]);

        $physicalCount->refresh();

        foreach ($physicalCount->getItems() as $item) {
            ProductInitializeInventoryJob::dispatch(
                Arr::get($item, 'product_id'),
                Arr::get($item, 'unit'),
                Arr::get($item, 'quantity')
            );
        }

        return new JsonResource($physicalCount);
    }
}
