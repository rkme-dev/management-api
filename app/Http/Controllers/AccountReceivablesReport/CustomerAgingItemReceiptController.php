<?php

declare(strict_types=1);

namespace App\Http\Controllers\AccountReceivablesReport;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerAgingItemReceiptController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(string $id)
    {
        $customer = Customer::where('id', $id)
                        ->whereHas('salesDrs', function ($q) {
                            $q->where('status','posted')
                            ->where('remaining_balance','>',0);
                        })
                        ->with('salesDrs',
                            'salesDrs.document',
                            'salesDrs.term')
                        ->first()?->toArray();

        $currency = new \NumberFormatter(
            'en_PH',
            \NumberFormatter::CURRENCY
        );

        $currency->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '');

        foreach ($customer['sales_drs'] ?? [] as $index => $item) {

            // $aged_date = Carbon::parse($item['date_posted'])->diffInDays(Carbon::today());

            $remaining_balance = $item['remaining_balance'];

            $term = $item['term'] ? (int) $item['term']['days'] : 0;

            $age_days = Carbon::parse($item['date_posted'])->diffInDays(Carbon::today());

            $transaction = $term - $age_days;

            $overdue_term = abs($transaction);

            $customer['sales_drs'][$index]['current'] = $transaction >= 0 ?  (string) $currency->format((float) $remaining_balance) : 0;
            
            $customer['sales_drs'][$index]['one_thirty'] = $transaction < 0 &&  $overdue_term <= 30 ?  (string) $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['thirtyone_sixty'] = $transaction < 0 && $overdue_term >= 31 && $overdue_term <= 60 ? (string) $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['sixtyone_ninety'] =  $transaction < 0 && $overdue_term >= 61 && $overdue_term <= 90 ? (string) $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['ninetyone_htwenty'] = $transaction < 0 && $overdue_term >= 91 && $overdue_term <= 120 ? (string) $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['htwentyone_hfifty'] = $transaction < 0 && $overdue_term >= 121 && $overdue_term <= 150 ? (string) $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['hfiftyone_heighty'] = $transaction < 0 && $overdue_term >= 151 && $overdue_term <= 180 ? (string) $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['heightyone_above'] = $transaction < 0 && $overdue_term >= 181 ? (string) $currency->format((float) $remaining_balance) : 0;
            
            $customer['sales_drs'][$index]['remaining_balance_curr'] = (string) $currency->format((float) $remaining_balance);

        }

        $title = 'for '.$customer['name'];

        $total = (string) $currency->format(collect($customer['sales_drs'])->reduce(function ($carry, $item) {
            return $carry + (float) $item['remaining_balance'];
        },0));
        
        $pdf = PDF::loadView('account-receivables/customer-aging', [
                'order' => $customer['sales_drs'],
                'all_customers' => false,
                'title' => $title,
                'total' => $total,
            ]
        );

        return $pdf->stream();

    }
}
