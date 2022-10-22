<?php

namespace App\Http\Controllers;

use App\Models\PurchaseOrder;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PurchaseOrderBarcodePrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $purchaseOrder = PurchaseOrder::find($id);

        $pdf = PDF::loadView('barcode', [
                'barcode' => $purchaseOrder->getAttribute('barcode'),
                'count' => $request->query('count'),
            ]
        );

        return $pdf->download(sprintf('purchase-order-%s.pdf', $purchaseOrder->getAttribute('id')));
    }
}
