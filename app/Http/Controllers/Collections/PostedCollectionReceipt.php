<?php

namespace App\Http\Controllers\Collections;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Collection;
use Carbon\Carbon;

class PostedCollectionReceipt extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {   
        $collection = Collection::where('status','posted')
                    ->with('salesDrPayments.salesDr', 'payments', 'salesDrPayments', 'customer', 'document')
                    ->where('id', $id)->first()?->toArray();


        $currency = new \NumberFormatter(
            'en_PH',
            \NumberFormatter::CURRENCY
        );
        
        $currency->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '');

        $collection['qr_code'] = $collection['qr_code'] ?? 'N/A';

        $collection['total_amount'] = $currency->format(collect($collection['payments'])->reduce(function ($carry, $item) {
            return $carry + (int) $item['amount'];
        }));

        $remaining_balance = $currency->format(collect($collection['sales_dr_payments'])->reduce(function ($carry, $item) {
            return $carry + (int) $item['sales_dr']['remaining_balance'];
        }));

        $collection['amount_collected'] = $currency->format((float) $remaining_balance - (float) $collection['total_amount']);

        $collection['balance'] = $remaining_balance;

        $collection['amount'] = $currency->format($collection['amount']);
        
        foreach ($collection['payments'] ?? [] as $index => $item) {

            $collection['payments'][$index]['amount'] = $currency->format($item['amount']);

            if(Str::contains($item['payment_type'], 'CashPayment') == true) {
                $collection['payments'][$index]['payment_type'] = "Cash Payment";
            }

            if(Str::contains($item['payment_type'], 'CheckPayment') == true) {
                $collection['payments'][$index]['payment_type'] = "Check Payment";
            }

            if(Str::contains($item['payment_type'], 'OnlinePayment') == true) {
                $collection['payments'][$index]['payment_type'] = "Online Payment";
            }
        }

        $pdf = PDF::loadView('collections/posted-collection-receipt', [
                'order' => $collection,
            ]
        );
        
        return $pdf->stream();
    }
}