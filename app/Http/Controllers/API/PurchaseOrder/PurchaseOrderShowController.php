<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\PurchaseOrder;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

final class PurchaseOrderShowController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        $totalPesoPaidAmount = null;
        $totalUSDPaidAmount = null;

        foreach ($purchaseOrder->paymentLogs as $paymentLog) {
            $pesoAmount = floatval(preg_replace('/[^0-9.]/', '', $paymentLog->getAttribute('peso_conversion')));
            $dollarAmount = floatval(preg_replace('/[^0-9.]/', '', $paymentLog->getAttribute('usd_conversion')));

            $totalPesoPaidAmount = $totalPesoPaidAmount + $pesoAmount;
            $totalUSDPaidAmount = $totalUSDPaidAmount + $dollarAmount;
        }

        $items = $purchaseOrder->orderItems;
        $supplier = $purchaseOrder->supplier;

        $payable = $purchaseOrder->getAttribute('total_amount_payable');
        $paid = $purchaseOrder->getAttribute('total');

        $purchaseOrder = $purchaseOrder->toArray();

        $purchaseOrder['total_quantity'] = 0;

        $orderItems = [];

        foreach ($items as $key => $item) {
            $attachedSupplier = $item->supplier;

            $orderItems[] = $item->product()->first();
            $orderItems[$key]['quantity'] = $item->getAttribute('quantity');
            $orderItems[$key]['actual_quantity'] = $item->getAttribute('actual_quantity');
            $orderItems[$key]['total_box'] = $item->getAttribute('total_box');
            $orderItems[$key]['pieces_per_box'] = $item->getAttribute('pieces_per_box');
            $orderItems[$key]['order_item_id'] = $item->getAttribute('id');
            $orderItems[$key]['supplier_name'] = $attachedSupplier?->getAttribute('name');

            $purchaseOrder['total_quantity'] += $item->getAttribute('quantity');
        }

        $balanceAmount = 0;

        if ($payable !== null && $paid !== null) {
            $balanceAmount = (float) $payable - (float) $paid;
        }
        $human_readable = new \NumberFormatter(
            'en_US',
            \NumberFormatter::CURRENCY
        );

        if ($totalPesoPaidAmount !== null && $totalUSDPaidAmount !== null) {
            $totalPesoPaidAmount = $human_readable->formatCurrency($totalPesoPaidAmount, 'PHP');
            $totalUSDPaidAmount = $human_readable->formatCurrency($totalUSDPaidAmount, 'USD');
        }

        if ($purchaseOrder['updated_at'] !== null) {
            $purchaseOrder['updated_at'] = (new Carbon($purchaseOrder['updated_at']))->format('Y-m-d\TH:i');
        }

        return $this->respondOK([
            'data' => [
                'order' => $purchaseOrder,
                'balance_amount' => $balanceAmount,
                'total_peso_paid_amount' => $totalPesoPaidAmount,
                'total_usd_paid_amount' => $totalUSDPaidAmount,
                'supplier' => $supplier,
                'items' => $orderItems,
            ],
        ]
        );
    }
}
