<?php

namespace App\Http\Controllers\Api\AccountReceivablesReport;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class CustomerAgingTransactionController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $customer = Customer::where('id',$id)
                    ->whereHas('salesDrs', function ($q) {
                        $q->where('status','posted')
                        ->where('remaining_balance','>',0);
                    })
                    ->with('salesDrs',
                            'salesDrs.document',
                            'salesDrs.term'
                        )->first()?->toArray();

        $currency = new \NumberFormatter(
            'en_PH',
            \NumberFormatter::CURRENCY
        );
        
        $currency->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '');

        foreach ($customer['sales_drs'] ?? [] as $index => $item) {

            $aged_date = Carbon::parse($item['date_posted'])->diffInDays(Carbon::today());

            $remaining_balance = $item['remaining_balance'];

            $customer['sales_drs'][$index]['aged_days'] = $aged_date;
            
            $customer['sales_drs'][$index]['one_thirty'] = $aged_date <= 30 ? $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['thirtyone_sixty'] = $aged_date >= 31 && $aged_date <= 60 ? $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['sixtyone_ninety'] =  $aged_date >= 61 && $aged_date <= 90 ? $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['ninetyone_htwenty'] = $aged_date >= 91 && $aged_date <= 120 ? $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['htwentyone_hfifty'] = $aged_date >= 121 && $aged_date <= 150 ? $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['hfiftyone_heighty'] = $aged_date >= 151 && $aged_date <= 180 ? $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['heightyone_above'] = $aged_date >= 181 ? $currency->format((float) $remaining_balance) : 0;

            $customer['sales_drs'][$index]['remaining_balance_num'] = (float) $item['remaining_balance'];
        }

        return $this->respondOK(
            [
                'data' => $customer['sales_drs']
            ]
        );
    }
}
