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
                
                $term = $item['term'] ? (int) $item['term']['days'] : 0;
                
                $age_days = Carbon::parse($item['date_posted'])->diffInDays(Carbon::today());

                $overdue = $term - $age_days;
                
                $customers[$index]['sales_drs'][$x]['term_days'] = $term;
                
                $customers[$index]['sales_drs'][$x]['age_days'] = $age_days;                
                
                $customers[$index]['sales_drs'][$x]['overdue'] = abs($overdue);
                
                $customers[$index]['sales_drs'][$x]['is_current'] = $overdue >= 0 ? true : false;
    
            }

            $totalPerCustomer = collect($customers[$index]['sales_drs']);
            
            $customers[$index]['current'] = (string) $currency->format($totalPerCustomer
                                            ->where('is_current',true)
                                            ->reduce(function ($carry, $item) {
                                                return $carry + (float) $item['remaining_balance'];
                                            },0));
            
            $customers[$index]['one_thirty_total'] = (string) $currency->format(
                                                    $totalPerCustomer
                                                    ->where('is_current',false)
                                                    ->where('overdue','<=',30)
                                                    ->reduce(function ($carry, $item) {
                                                        return $carry + (float) $item['remaining_balance'];
                                                    },0));

            $customers[$index]['thirtyone_sixty_total'] = (string) $currency->format( 
                                                    $totalPerCustomer
                                                    ->where('is_current',false)
                                                    ->where('overdue','>=',31)
                                                    ->where('overdue','<=',60)
                                                    ->reduce(function ($carry, $item) {
                                                        return $carry + (float) $item['remaining_balance'];
                                                    },0));

            $customers[$index]['sixtyone_ninety_total'] = (string) $currency->format( 
                                                $totalPerCustomer
                                                ->where('is_current',false)
                                                ->where('overdue','>=',61)
                                                ->where('overdue','<=',90)
                                                ->reduce(function ($carry, $item) {
                                                    return $carry + (float) $item['remaining_balance'];
                                                },0));

            $customers[$index]['ninetyone_htwenty_total'] = (string) $currency->format( $totalPerCustomer
                                                ->where('is_current',false)
                                                ->where('overdue','>=',91)
                                                ->where('overdue','<=',120)
                                                ->reduce(function ($carry, $item) {
                                                    return $carry + (float) $item['remaining_balance'];
                                                },0));

            $customers[$index]['htwentyone_hfifty_total'] = (string) $currency->format( $totalPerCustomer
                                                ->where('is_current',false)
                                                ->where('overdue','>=',121)
                                                ->where('overdue','<=',150)
                                                ->reduce(function ($carry, $item) {
                                                    return $carry + (float) $item['remaining_balance'];
                                                },0));

            $customers[$index]['hfiftyone_heighty_total'] = (string) $currency->format( $totalPerCustomer
                                            ->where('is_current',false)
                                            ->where('overdue','>=',151)
                                            ->where('overdue','<=',180)
                                            ->reduce(function ($carry, $item) {
                                                return $carry + (float) $item['remaining_balance'];
                                            },0));

            $customers[$index]['heightyone_above_total'] = (string) $currency->format( $totalPerCustomer
                                                ->where('is_current',false)
                                                ->where('overdue','>=',180)
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
