<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;

class CustomerAgingTransactionController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $customer = Customer::where('id',$id)
                    ->doesntHave('collections')
                    ->whereHas('salesDrs', function ($q) {
                        $q->where('status','posted');
                    })
                    ->with('salesDrs',
                            'salesDrs.document',
                            'salesDrs.term'
                        )->first()?->toArray();

        foreach ($customer['sales_drs'] ?? [] as $index => $item) {

            $aged_date = Carbon::parse($item['date_posted'])->diffInDays(Carbon::today());

            $remaining_balance = $item['remaining_balance'];

            $customer['sales_drs'][$index]['aged_days'] = $aged_date;
            
            $customer['sales_drs'][$index]['one_thirty'] = $aged_date <= 30 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['thirtyone_sixty'] = $aged_date >= 31 && $aged_date <= 60 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['sixtyone_ninety'] =  $aged_date >= 61 && $aged_date <= 90 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['ninetyone_htwenty'] = $aged_date >= 91 && $aged_date <= 120 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['htwentyone_hfifty'] = $aged_date >= 121 && $aged_date <= 150 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['hfiftyone_heighty'] = $aged_date >= 151 && $aged_date <= 180 ? $remaining_balance : 0;

            $customer['sales_drs'][$index]['heightyone_above'] = $aged_date >= 181 ? $remaining_balance : 0;

        }

        $customer['one_thirty_total'] = 0;

        $customer['thirtyone_sixty_total'] = 0;

        $customer['sixtyone_ninety_total'] = 0;

        $customer['ninetyone_htwenty_total'] = 0;

        $customer['htwentyone_hfifty_total'] = 0;

        $customer['hfiftyone_heighty_total'] = 0;

        $customer['heightyone_above_total'] = 0;

        return $this->respondOK(
            [
                'data' => $customer
            ]
        );
    }
}
