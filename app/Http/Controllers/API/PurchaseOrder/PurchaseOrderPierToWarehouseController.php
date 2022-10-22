<?php

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Enums\PurchaseOrderStatusEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\PurchaseOrder\PurchaseOrderPierToWarehouseRequest;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderLogs;

final class PurchaseOrderPierToWarehouseController extends AbstractAPIController
{
    public function __invoke(PurchaseOrderPierToWarehouseRequest $request, int $id)
    {
        $updateStatus = PurchaseOrderStatusEnum::PIER_TO_WAREHOUSE->value;
        $expectedStatus = PurchaseOrderStatusEnum::IN_TRANSIT->value;

        try {

            $order = PurchaseOrder::where([
                'status' => $expectedStatus,
                'active' => true,
                'id' => $request->get('id'),
            ])->firstOrFail();

            $rawMaterials = $request->get('raw_materials');
            $orderItems = $order->orderItems;

            foreach ($rawMaterials as $rawMaterial) {
                $actualQuantity = (int) $rawMaterial['total_box'] * (int) $rawMaterial['pieces_per_box'] ;

                $orderItem = $orderItems->where('product_id', $rawMaterial['id'])->first();
                $orderItem->setAttribute('total_box', $rawMaterial['total_box']);
                $orderItem->setAttribute('pieces_per_box', $rawMaterial['pieces_per_box']);
                $orderItem->setAttribute('actual_quantity', $actualQuantity);
                $orderItem->save();
            }

            $order->update([
                'status' => $updateStatus,
                'eta' => $request->get('eta'),
                'container_number' => $request->get('container_number'),
                'courier_name' => $request->get('courier_name'),
                'courier_number' => $request->get('courier_number'),
                'barcode' => \sprintf('%s', $request->get('container_number')),
            ]);

            $this->attachLogs($request->user()->getAttribute('id'), $id, $updateStatus);


            return $this->respondOk($order->get()->toArray());
        } catch (\Throwable $exception) {
            return $this->respondInternalError($exception->getMessage());
        }
    }

    private function attachLogs(string $userId, string $id, string $updateStatus): void
    {
        $this->attachPurchaseOrderLog($userId, $id, $updateStatus);
    }

    private function attachPurchaseOrderLog(string $userId, string $id, string $updateStatus): void
    {
        PurchaseOrderLogs::create([
            'message' => \sprintf('Purchase Order: %s has been marked as moving from pier to warehouse.', $id),
            'status' => $updateStatus,
            'order_id' => $id,
            'user_id' => $userId,
            'action' => 'Updated',
        ]);
    }
}
