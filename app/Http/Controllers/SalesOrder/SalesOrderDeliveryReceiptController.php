<?php

namespace App\Http\Controllers\SalesOrder;

use App\Enums\PrintCopyEnums;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\SalesDr;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesOrderDeliveryReceiptController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $salesOrder = SalesDr::with('payments', 'salesDrItems.tripTicket', 'document', 'salesman1', 'salesman2', 'vat', 'orderItems', 'customer', 'term')
            ->where('id', $id)->first();

        $dr = $salesOrder;

        $salesOrder = $salesOrder?->toArray();

        $currency = new \NumberFormatter(
            'en_PH',
            \NumberFormatter::CURRENCY
        );

        $currency->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '');

        $plateNumber = '';

        $salesOrder['qr_code'] = $salesOrder['qr_code'] ?? 'N/A';

        foreach ($salesOrder['sales_dr_items'] ?? [] as $item) {
            if (empty($item['trip_ticket']['plate_number'] ?? null) === false) {
                $plateNumber = $item['trip_ticket']['plate_number'];

                break;
            }
        }

        $salesOrder['plate_number'] = $plateNumber;
        $salesOrder['amount'] = $currency->format($salesOrder['amount']);
        $salesOrder['created_at'] = new Carbon($salesOrder['created_at']);

        /**
         * Getting the legit SALES ORDER
         */
        $legitSalesOrder = [];

        /** @var OrderItem $orderItem */
        foreach ($dr->orderItems as $orderItem) {
            $legitSalesOrder[] = [
                'sales_order_number' => $orderItem->salesDrItem->salesOrderItem->orderable->getAttribute('sales_order_number'),
                'product_name' => $orderItem->product->getAttribute('name'),
                'quantity' => number_format($orderItem->getAttribute('quantity')),
                'price' => number_format($orderItem->getAttribute('price')),
                'total_amount' => number_format($orderItem->getAttribute('total_amount')),
            ];
        }
        $salesOrder['legit_order_items'] = $legitSalesOrder;

        $copies = PrintCopyEnums::cases();

        // return view('sales-order/delivery-receipt', [
        //     'order' => $salesOrder,
        //     'copies' => $copies]);
        $pdf = PDF::loadView('sales-order/delivery-receipt', [
            'order' => $salesOrder,
            'copies' => $copies,
        ]
        );

        return $pdf->stream();
        //return $pdf->download('some-barcode.pdf');
    }
}
