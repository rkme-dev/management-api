<?php

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Enums\PurchaseOrderPaymentTypeEnum;
use App\Enums\PurchaseOrderStatusEnum;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\PurchaseOrder\PurchaseOrderInTransitRequest;
use App\Models\PaymentLogs;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderLogs;

final class PurchaseOrderInTransitController extends AbstractAPIController
{
    public function __invoke(PurchaseOrderInTransitRequest $request, int $id)
    {
        $updateStatus = PurchaseOrderStatusEnum::IN_TRANSIT->value;
        $expectedStatus = PurchaseOrderStatusEnum::APPROVED->value;

        try {
            $total = $request->get('paid_amount');

            $order = PurchaseOrder::where([
                'status' => $expectedStatus,
                'active' => true,
                'id' => $request->get('id'),
            ])->firstOrFail();

            $order->update([
                'status' => $updateStatus,
                'total' => \bcadd($total, $order->getAttribute('total'), 2),
            ]);

            $paymentLogDto = [
                'usd_conversion' => $request->get('usd_conversion'),
                'peso_conversion' => $request->get('peso_conversion'),
                'conversion_rate' => $request->get('conversion_rate'),
                'fx_id' => $request->get('fx_number'),
            ];

            $userId = $request->user()->getAttribute('id');

            $this->attachLogs($userId, $id, $updateStatus, $total, $paymentLogDto);

            if ($request->has('expenses') === true) {
                $this->attachExpenseLogs($id, $userId, $request->get('expenses'));
            }

            return $this->respondOk($order->get()->toArray());
        } catch (\Throwable $exception) {
            return $this->respondInternalError($exception->getMessage());
        }
    }

    private function attachExpenseLogs(string $orderId, $userId, array $expenses): void
    {
        foreach ($expenses as $expense) {
            PaymentLogs::create([
                'amount' => $expense['amount'],
                'message' => \sprintf('Other Expense Payment made to %s. -- %s', $expense['paid_to'], $expense['description']),
                'paid_to' => $expense['paid_to'],
                'conversion_rate' => 'N/A',
                'peso_conversion' => 'N/A',
                'usd_conversion' => 'N/A',
                'orderable_id' => $orderId,
                'orderable_type' => PurchaseOrder::class,
                'fx_id' => 'N/A',
                'user_id' => $userId,
                'type' => PurchaseOrderPaymentTypeEnum::OTHER,
            ]);
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
            'message' => \sprintf('Balance paid for Purchase Order %s', $id),
            'orderable_id' => $id,
            'amount' => \sprintf('$%s', $total),
            'orderable_type' => PurchaseOrder::class,
            'conversion_rate' => $paymentDto['conversion_rate'],
            'peso_conversion' => \sprintf('P%s', $paymentDto['peso_conversion']),
            'usd_conversion' => \sprintf('P%s', $paymentDto['usd_conversion']),
            'paid_to' => $paymentDto['paid_to'] ?? null,
            'type' => PurchaseOrderPaymentTypeEnum::STANDARD,
        ]);
    }

    private function attachPurchaseOrderLog(string $userId, string $id, string $updateStatus): void
    {
        PurchaseOrderLogs::create([
            'message' => \sprintf('Purchase Order: %s has been marked as in transit.', $id),
            'status' => $updateStatus,
            'order_id' => $id,
            'user_id' => $userId,
            'action' => 'Updated',
        ]);
    }
}
