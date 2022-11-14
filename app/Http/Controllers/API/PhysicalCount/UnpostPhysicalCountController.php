<?php

namespace App\Http\Controllers\API\PhysicalCount;

use App\Enums\PhysicalCountStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Jobs\Reports\RemoveStockcardReportJob;
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

        foreach ($physicalCount->getItems() as $item) {
            RemoveStockcardReportJob::dispatch(get_class($item), $item->getAttribute('id'));
        }

        return new JsonResource($physicalCount);
    }
}
