<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PhysicalCount;

use App\Enums\PhysicalCountStatusesEnum;
use App\Models\PhysicalCount;
use App\Models\CountItem;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\PhysicalCount\CreatePhysicalCountRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class CreatePhysicalCountController extends AbstractAPIController
{
    public function __invoke(CreatePhysicalCountRequest $request): JsonResource
    {
        $physicalCount = DB::transaction(
            function () use ($request) {
                $physicalCount = PhysicalCount::create(
                    array_merge(
                        Arr::except(
                            $request->validated(),
                            ['count_items']
                        ),
                        [
                            'status' => PhysicalCountStatusesEnum::FOR_REVIEW->value,
                            'created_by' => $this->getUser()->getId(),
                        ]
                    )
                );

                if (!$physicalCount) {
                    return;
                }

                $this->setCountItems($physicalCount, $request->get('count_items'));

                return $physicalCount;
            }
        );

        return new JsonResource($physicalCount);
    }

    private function setCountItems(PhysicalCount $count, array $items): void
    {
        foreach ($items as $item) {
            $countItem = new CountItem();
            $countItem->setAttribute('physical_count_id', $count->getAttribute('id'));
            $countItem->setAttribute('brand', Arr::get($item, 'brand'));
            $countItem->setAttribute('product_id', Arr::get($item, 'product_id'));
            $countItem->setAttribute('group_1', Arr::get($item, 'group_1'));
            $countItem->setAttribute('group_2', Arr::get($item, 'group_2'));
            $countItem->setAttribute('unit', Arr::get($item, 'unit'));
            $countItem->setAttribute('quantity', Arr::get($item, 'quantity'));
            $countItem->setAttribute('cost', Arr::get($item, 'cost'));
            $countItem->setAttribute('total_amount', Arr::get($item, 'total_amount'));
            $countItem->save();
        }
    }
}
