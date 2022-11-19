<?php

declare(strict_types=1);

namespace App\Http\Controllers\AccountReceivablesReport;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;

class CustomerAgingReceiptController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $customers = Customer::whereHas('salesDrs', function ($q) {
                            $q->where('status','posted')
                            ->where('remaining_balance','>',0);
                        })
                        ->with('salesDrs',
                            'salesDrs.document',
                            'salesDrs.term');

        if ($request->has('cId')) {
            $customers = $customers->where('id', $request->get('cId'));
        }
        $customers = $customers->get()?->toArray();

        $currency = new \NumberFormatter(
            'en_PH',
            \NumberFormatter::CURRENCY
        );

        $currency->setSymbol(\NumberFormatter::CURRENCY_SYMBOL, '');

        foreach ($customers ?? [] as $index => $customer) {

            $customers[$index]['is_per_customer'] = false;

            foreach ($customers[$index]['sales_drs'] ?? [] as $x => $item) {

                $aged_date = Carbon::parse($item['date_posted'])->diffInDays(Carbon::today());
    
                $remaining_balance = $item['remaining_balance'];
    
                $customers[$index]['sales_drs'][$x]['aged_days'] = $aged_date;
                
                $customers[$index]['sales_drs'][$x]['one_thirty'] = $aged_date <= 30 ?  $remaining_balance : 0;
    
                $customers[$index]['sales_drs'][$x]['thirtyone_sixty'] = $aged_date >= 31 && $aged_date <= 60 ? $remaining_balance : 0;
    
                $customers[$index]['sales_drs'][$x]['sixtyone_ninety'] =  $aged_date >= 61 && $aged_date <= 90 ? $remaining_balance : 0;
    
                $customers[$index]['sales_drs'][$x]['ninetyone_htwenty'] = $aged_date >= 91 && $aged_date <= 120 ? $remaining_balance : 0;
    
                $customers[$index]['sales_drs'][$x]['htwentyone_hfifty'] = $aged_date >= 121 && $aged_date <= 150 ? $remaining_balance : 0;
    
                $customers[$index]['sales_drs'][$x]['hfiftyone_heighty'] = $aged_date >= 151 && $aged_date <= 180 ? $remaining_balance : 0;
    
                $customers[$index]['sales_drs'][$x]['heightyone_above'] = $aged_date >= 181 ? $remaining_balance : 0;
    
            }

            $totalPerCustomer = collect($customers[$index]['sales_drs']);
            
            $customers[$index]['one_thirty_total'] = (string) $currency->format($totalPerCustomer->where('aged_days','<=',30)
                                                    ->reduce(function ($carry, $item) {
                                                        return $carry + (float) $item['remaining_balance'];
                                                    },0));

            $customers[$index]['thirtyone_sixty_total'] = (string) $currency->format($totalPerCustomer
                                                    ->where('aged_days','>=',31)
                                                    ->where('aged_days','<=',60)
                                                    ->reduce(function ($carry, $item) {
                                                        return $carry + (float) $item['remaining_balance'];
                                                    },0));

            $customers[$index]['sixtyone_ninety_total'] = (string) $currency->format($totalPerCustomer
                                                ->where('aged_days','>=',61)
                                                ->where('aged_days','<=',90)
                                                ->reduce(function ($carry, $item) {
                                                    return $carry + (float) $item['remaining_balance'];
                                                },0));

            $customers[$index]['ninetyone_htwenty_total'] = (string) $currency->format($totalPerCustomer
                                                ->where('aged_days','>=',91)
                                                ->where('aged_days','<=',120)
                                                ->reduce(function ($carry, $item) {
                                                    return $carry + (float) $item['remaining_balance'];
                                                },0));

            $customers[$index]['htwentyone_hfifty_total'] = (string) $currency->format($totalPerCustomer
                                                ->where('aged_days','>=',121)
                                                ->where('aged_days','<=',150)
                                                ->reduce(function ($carry, $item) {
                                                    return $carry + (float) $item['remaining_balance'];
                                                },0));

            $customers[$index]['hfiftyone_heighty_total'] = (string) $currency->format($totalPerCustomer
                                            ->where('aged_days','>=',151)
                                            ->where('aged_days','<=',180)
                                            ->reduce(function ($carry, $item) {
                                                return $carry + (float) $item['remaining_balance'];
                                            },0));

            $customers[$index]['heightyone_above_total'] = (string) $currency->format($totalPerCustomer
                                                ->where('aged_days','>=',180)
                                                ->reduce(function ($carry, $item) {
                                                    return $carry + (float) $item['remaining_balance'];
                                                },0));

            $customers[$index]['total'] =  $totalPerCustomer->reduce(function ($carry, $item) {
                                                return $carry + (float) $item['remaining_balance'];
                                            },0);

            $customers[$index]['total_currency'] = $currency->format($customers[$index]['total']);

        }

        if ($request->has('cId')) {
            $customers = $customers[0]['sales_drs'];
            $customers[0]['is_per_customer'] = true;
        } 

        $title = $request->has('cId') ? 'for '.$customers[0]['name'] : 'as of '.Carbon::today()->format('d-m-Y');

        // return $customers;

        $total = (string) $currency->format(collect($customers)->reduce(function ($carry, $item) {
            return $carry + (float) $item['total'];
        },0));
        
        $pdf = PDF::loadView('account-receivables/customer-aging', [
                'order' => $customers,
                'all_customers' => $request->has('cId') ? false : true,
                'title' => $title,
                'total' => $total,
            ]
        );

        return $pdf->stream();

    }
}
