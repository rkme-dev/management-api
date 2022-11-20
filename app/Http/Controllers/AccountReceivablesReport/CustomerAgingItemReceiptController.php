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

            $aged_date = Carbon::parse($item['date_posted'])->diffInDays(Carbon::today());

            $remaining_balance = $item['remaining_balance'];

            $customer['sales_drs'][$index]['aged_days'] = $aged_date;
            
            $customer['sales_drs'][$index]['one_thirty'] = $aged_date <= 30 ?  $remaining_balance : 0;

            $customer['sales_drs'][$index]['thirtyone_sixty'] = $aged_date >= 31 && $aged_date <= 60 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['sixtyone_ninety'] =  $aged_date >= 61 && $aged_date <= 90 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['ninetyone_htwenty'] = $aged_date >= 91 && $aged_date <= 120 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['htwentyone_hfifty'] = $aged_date >= 121 && $aged_date <= 150 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['hfiftyone_heighty'] = $aged_date >= 151 && $aged_date <= 180 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['heightyone_above'] = $aged_date >= 181 ? $remaining_balance : 0;

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
