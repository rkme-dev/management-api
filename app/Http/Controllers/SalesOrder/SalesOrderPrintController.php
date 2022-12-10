<?php

namespace App\Http\Controllers\SalesOrder;

use App\Http\Controllers\Controller;
use App\Models\SalesOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class SalesOrderPrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $salesOrder = SalesOrder::with('vat', 'customer', 'term', 'salesman1', 'salesman2', 'document', 'orderItems')->findOrFail($id);

        $pdf = PDF::loadView('sales-order.sales-order', [
            'order' => $salesOrder,
        ]
        );

        return $pdf->download('some-sales-order.pdf');
    }
}
