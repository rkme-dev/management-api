<?php

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Enums\PurchaseOrderStatusEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\PurchaseOrder\PurchaseOrderStockArrivalRequest;
use App\Models\PurchaseOrder;
use Illuminate\Support\Carbon;

final class PurchaseOrderStockArrivalController extends AbstractAPIController
{
    public function __invoke(PurchaseOrderStockArrivalRequest $request, int $id)
    {
        $updateStatus = PurchaseOrderStatusEnum::ARRIVED->value;
        $expectedStatus = PurchaseOrderStatusEnum::PIER_TO_WAREHOUSE->value;

        try {
            $order = PurchaseOrder::where([
                'id' => $id,
                'active' => true,
                'status' => $expectedStatus,
            ])->firstOrFail();

            $order->update([
                'arrived_at' => Carbon::now(),
                'status' => $updateStatus,
            ]);

            return $this->respondOk($order->get()->toArray());
        } catch (\Throwable $exception) {
            return $this->respondInternalError($exception->getMessage());
        }
    }
}
