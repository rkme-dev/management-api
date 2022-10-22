<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseOrderPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);

        $items = $purchaseOrder->orderItems;
        $supplier = $purchaseOrder->supplier;

        $orderNumber = \str_pad((string) $purchaseOrder->id,8,"0",STR_PAD_LEFT);

        $orderNumber = sprintf('PO-%s', $orderNumber);

        $orderItems = [];
        foreach ($items as $key => $item) {
            $attachedSupplier = $item->supplier;

            $orderItems[] = $item->product()->first();
            $orderItems[$key]['quantity'] = $item->getAttribute('quantity');
            $orderItems[$key]['order_item_id'] = $item->getAttribute('id');
            $orderItems[$key]['supplier_name'] = $attachedSupplier?->getAttribute('name');
        }

        $order = $purchaseOrder->toArray();
        $order['created_at'] = new Carbon($order['created_at']);

        $pdf = PDF::loadView('purchase_order', [
                'orderNumber' => $orderNumber,
                'order' => $order,
                'items' => $orderItems,
                'supplier' => $supplier,
            ]
        );

        return $pdf->download('some-barcode.pdf');
    }
}
