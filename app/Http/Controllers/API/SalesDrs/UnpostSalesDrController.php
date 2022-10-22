<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\SalesDrs;

use App\Enums\SaleOrderStatusesEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Models\SalesDr;
use Illuminate\Http\Resources\Json\JsonResource;

final class UnpostSalesDrController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        /** @var SalesDr $salesDr */
        $salesDr = SalesDr::with('orderItems')->where('id', $id)->first();

        $salesDr->update([
            'status' => SaleOrderStatusesEnum::FOR_REVIEW->value,
            'updated_by' => $this->getUser()->getId(),
        ]);

        $salesDr->refresh();

        return new JsonResource($salesDr);
    }
}
