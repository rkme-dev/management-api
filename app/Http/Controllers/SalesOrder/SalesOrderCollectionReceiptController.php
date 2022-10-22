<?php

namespace App\Http\Controllers\SalesOrder;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalesOrderCollectionReceiptController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $salesOrder = SalesOrder::with('orderItems','customer','term')->where('id', $id)->first()->toArray();

        $currency = new \NumberFormatter(
            'en_US',
            \NumberFormatter::CURRENCY
        );

        $salesOrder['amount'] = $currency->format($salesOrder['amount']);
        $salesOrder['created_at'] = new Carbon($salesOrder['created_at']);

        $pdf = PDF::loadView('sales-order/collection-receipt', [
                'order' => $salesOrder,
            ]
        );

        return $pdf->stream();
        //return $pdf->download('some-barcode.pdf');
    }
}
