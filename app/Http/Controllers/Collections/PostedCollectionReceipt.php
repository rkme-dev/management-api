<?php

namespace App\Http\Controllers\Collections;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostedCollectionReceipt extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, string $id)
    {
        $collection = Collection::where('status', 'posted')
                    ->with('salesDrPayments.salesDr', 'payments', 'salesDrPayments', 'customer', 'document')
                    ->where('id', $id)->first()?->toArray();

        $currency = new \NumberFormatter(
            'en_PH',
            \NumberFormatter::CURRENCY
        );

        $currency->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '');

        $collection['qr_code'] = $collection['qr_code'] ?? 'N/A';

        $total_amount_num = collect($collection['payments'])->reduce(function ($carry, $item) {
            return $carry + (float) $item['amount'];
        });

        $remaining_balance_num = collect($collection['sales_dr_payments'])->reduce(function ($carry, $item) {
            return $carry + (float) $item['sales_dr']['remaining_balance'];
        });

        $collection['total_amount'] = $currency->format($total_amount_num);

        $remaining_balance = $currency->format($remaining_balance_num);

        $collection['amount_collected'] = $currency->format((float) $total_amount_num - (float) $remaining_balance_num);

        $collection['balance'] = $remaining_balance;

        $collection['amount'] = $currency->format($collection['amount']);

        foreach ($collection['payments'] ?? [] as $index => $item) {
            $collection['payments'][$index]['amount'] = $currency->format($item['amount']);

            if (Str::contains($item['payment_type'], 'CashPayment') == true) {
                $collection['payments'][$index]['payment_type'] = 'Cash Payment';
            }

            if (Str::contains($item['payment_type'], 'CheckPayment') == true) {
                $collection['payments'][$index]['payment_type'] = 'Check Payment';
            }

            if (Str::contains($item['payment_type'], 'OnlinePayment') == true) {
                $collection['payments'][$index]['payment_type'] = 'Online Payment';
            }
        }

        $pdf = PDF::loadView('collections/posted-collection-receipt', [
            'order' => $collection,
        ]
        );

        return $pdf->stream();
    }
}
