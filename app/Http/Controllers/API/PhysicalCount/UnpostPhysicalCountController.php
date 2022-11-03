<?php

namespace App\Http\Controllers\API\PhysicalCount;

use App\Enums\PhysicalCountStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\PhysicalCount;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnpostPhysicalCountController extends AbstractAPIController
{
    public function __invoke(PhysicalCount $physicalCount): JsonResource
    {
        $physicalCount->load('countItems')
            ->update([
                'status' => PhysicalCountStatusesEnum::FOR_REVIEW->value,
                'updated_by' => $this->getUser()->getId(),
            ]);

        $physicalCount->refresh();

        return new JsonResource($physicalCount);
    }
}
