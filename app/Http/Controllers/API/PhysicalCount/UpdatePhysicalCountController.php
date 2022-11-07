<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PhysicalCount;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\CountItem;
use App\Models\PhysicalCount;
use App\Http\Requests\PhysicalCount\UpdatePhysicalCountRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

final class UpdatePhysicalCountController extends AbstractAPIController
{
    public function __invoke(UpdatePhysicalCountRequest $request, PhysicalCount $physicalCount): JsonResource
    {
        $physicalCount = DB::transaction(
            function () use ($request, $physicalCount) {
                $physicalCount->load('countItems')
                    ->update(
                        Arr::except(
                            $request->validated(),
                            ['count_items']
                        )
                    );
                
                $this->setCountItems($physicalCount, $request->get('count_items'));

                return $physicalCount;
            }
        );

        return new JsonResource($physicalCount);
    }

    private function setCountItems(PhysicalCount $count, array $items): void
    {
        $ids = Arr::pluck($items, 'id');

        CountItem::whereNotIn('id', $ids)
            ->where('physical_count_id', $count->getAttribute('id'))
            ->delete();

        $existingCountItems = CountItem::whereIn('id', $ids)->get();

        foreach ($items as $item) {
            if (Arr::get($item, 'id') === null) {
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

                continue;
            }

            $existingCountItem = $existingCountItems->where('id', Arr::get($item, 'id'))->first();

            if ($existingCountItem === null) {
                continue;
            }

            $existingCountItem->update($item);
        }

        $count->refresh();
    }
}
