<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\SalesDr;
use Illuminate\Http\Resources\Json\JsonResource;

final class PostSalesDrController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var SalesDr $salesDr */
        $salesDr = SalesDr::with('orderItems')->where('id', $id)->first();

        $salesDr->update([
            'status' => SaleOrderStatusesEnum::POSTED->value,
            'updated_by' => $this->getUser()->getId(),
        ]);

        $salesDr->refresh();

        /** @var OrderItem $orderItem */
        foreach ($salesDr->orderItems as $orderItem) {
            $unit = $orderItem->product->units->where('name', $orderItem->getAttribute('unit'))->first();;

            $remaining = (float) $unit->pivot->getAttribute('actual_balance') - (float) $orderItem->getAttribute('actual_quantity');

            $unit->pivot->setAttribute('actual_balance', $remaining);

            $unit->pivot->save();

            $unit->pivot->refresh();
        }

        return new JsonResource($salesDr);
    }
}
