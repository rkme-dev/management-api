<?php

namespace App\Http\Controllers\SalesOrder;

use App\Enums\PrintCopyEnums;
use App\Http\Controllers\Controller;
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
        $salesOrder = SalesDr::with('payments', 'salesDrItems.tripTicket', 'document', 'salesman1', 'salesman2', 'vat', 'orderItems.product', 'customer', 'term')
            ->where('id', $id)->first()?->toArray();

        $currency = new \NumberFormatter(
            'en_PH',
            \NumberFormatter::CURRENCY
        );

        $currency->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '');

        $plateNumber = '';

        $salesOrder['qr_code'] = $salesOrder['qr_code'] ?? 'N/A';

        foreach ($salesOrder['order_items'] ?? [] as $index => $item) {
            $salesOrder['order_items'][$index]['total_amount'] = $currency->format($item['total_amount']);
        }


        foreach ($salesOrder['sales_dr_items'] ?? [] as $item) {
            if (empty($item['trip_ticket']['plate_number'] ?? null) === false ) {
                $plateNumber = $item['trip_ticket']['plate_number'];

                break;
            }
        }

        $salesOrder['plate_number'] = $plateNumber;
        $salesOrder['amount'] = $currency->format($salesOrder['amount']);
        $salesOrder['created_at'] = new Carbon($salesOrder['created_at']);

        $copies = PrintCopyEnums::cases();

        $pdf = PDF::loadView('sales-order/delivery-receipt', [
                'order' => $salesOrder,
                'copies' => $copies
            ]
        );

        return $pdf->stream();
        //return $pdf->download('some-barcode.pdf');
    }
}
