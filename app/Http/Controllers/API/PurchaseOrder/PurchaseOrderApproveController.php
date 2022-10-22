<?php

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Enums\PurchaseOrderPaymentTypeEnum;
use App\Enums\PurchaseOrderStatusEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\PurchaseOrder\PurchaseOrderApproveRequest;
use App\Models\PaymentLogs;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderLogs;

final class PurchaseOrderApproveController extends AbstractAPIController
{
    public function __invoke(PurchaseOrderApproveRequest $request, int $id)
    {
        $updateStatus = PurchaseOrderStatusEnum::APPROVED->value;
        $expectedStatus = PurchaseOrderStatusEnum::PENDING_APPROVAL->value;
        $total = $request->get('total');

        try {
            $order = PurchaseOrder::where([
                'id' => $id,
                'active' => true,
                'status' => $expectedStatus,
            ])->firstOrFail();


            $rawMaterials = $request->get('raw_materials');
            $orderItems = $order->orderItems;

            foreach ($rawMaterials as $rawMaterial) {
                $orderItem = $orderItems->where('product_id', $rawMaterial['id'])->first();
                $orderItem->setAttribute('quantity', $rawMaterial['quantity']);
                $orderItem->save();
            }

            $order->update([
                'description' => $request->get('description'),
                'status' => $updateStatus,
                'total' => $request->get('paid_amount'),
                'total_amount_payable' => $total,
                'subtotal' => $total,
                'supplier_id' => $request->get('supplier_id'),
            ]);

            $paymentLogDto = [
                'usd_conversion' => $request->get('usd_conversion'),
                'peso_conversion' => $request->get('peso_conversion'),
                'conversion_rate' => $request->get('conversion_rate'),
                'dp_percentage' => $request->get('dp_percentage'),
                'fx_id' => $request->get('fx_number'),
            ];

            $this->attachLogs($request->user()->getAttribute('id'), $id, $updateStatus, $total, $paymentLogDto);

            return $this->respondOk($order->get()->toArray());
        } catch (\Throwable $exception) {
            return $this->respondInternalError($exception->getMessage());
        }
    }

    private function attachLogs(string $userId, string $id, string $updateStatus, ?string $paidAmount, array $paymentDto): void
    {
        $this->attachPurchaseOrderLog($userId, $id, $updateStatus);

        if ($paidAmount === null) {
            return;
        }

        $this->attachPaymentLog($userId, $id, $updateStatus, $paidAmount, $paymentDto);
    }

    private function attachPaymentLog(string $userId, string $id, string $updateStatus, string $total, array $paymentDto): void
    {
        PaymentLogs::create([
            'fx_id' => $paymentDto['fx_id'],
            'user_id' => $userId,
            'message' => \sprintf('Downpayment transaction for Purchase Order %s', $id),
            'orderable_id' => $id,
            'amount' => $paymentDto['usd_conversion'],
            'orderable_type' => PurchaseOrder::class,
            'conversion_rate' => $paymentDto['conversion_rate'],
            'peso_conversion' => $paymentDto['peso_conversion'],
            'usd_conversion' => $paymentDto['usd_conversion'],
            'dp_percentage' => $paymentDto['dp_percentage'],
            'type' => PurchaseOrderPaymentTypeEnum::STANDARD,
        ]);
    }

    private function attachPurchaseOrderLog(string $userId, string $id, string $updateStatus): void
    {
        PurchaseOrderLogs::create([
            'message' => \sprintf('Purchase Order: %s has been approved', $id),
            'status' => $updateStatus,
            'order_id' => $id,
            'user_id' => $userId,
            'action' => 'Approved',
        ]);
    }
}
