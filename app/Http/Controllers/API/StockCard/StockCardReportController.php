<?php

namespace App\Http\Controllers\API\StockCard;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Stockcard\StockcardRequest;
use App\Models\Product;
use App\Models\StockcardReport;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StockCardReportController extends AbstractAPIController
{
    public function __invoke(StockcardRequest $request, Product $product): JsonResource
    {
        $unit = $request->getUnit();
        $fromDate = $request->getFromDate();
        $toDate = $request->getToDate();

        $result = StockcardReport::where('product_id', $product->getAttribute('id'))
            ->where(function ($query) use ($fromDate, $toDate, $unit){
                if ($fromDate !== null) {
                    $query->where('date', '>=', $fromDate);
                }

                if ($toDate !== null) {
                    $query->where('date', '<=', $toDate);
                }

                if ($unit !== null) {
                    $query->where('unit', '=', $unit);
                }
            })
            ->orderBy('id', 'asc')
            ->orderBy('unit', 'desc')
            ->orderBy('morphable_type', 'desc')
            ->orderBy('morphable_id', 'desc')
            ->get();

        $result = $result->map(function (StockcardReport $stockcardReport) {
            return [
                'date' => (new Carbon($stockcardReport->getAttribute('date')))->toDateTimeString(),
                'event' => $stockcardReport->getAttribute('event'),
                'document' => $stockcardReport->getAttribute('document'),
                'document_number' => $stockcardReport->getAttribute('document_number'),
                'remarks'  => $stockcardReport->getAttribute('remarks'),
                'quantity' => number_format($stockcardReport->getAttribute('quantity')),
                'unit' => $stockcardReport->getAttribute('unit'),
                'price' => number_format($stockcardReport->getAttribute('price'), 2, '.'),
                'status' => 'Good',
                'quantity_in' => number_format($stockcardReport->getAttribute('quantity_in')),
                'quantity_out' => number_format($stockcardReport->getAttribute('quantity_out')),
                'balance'  => number_format($stockcardReport->getAttribute('balance')),
            ];
        });

        return new JsonResource($result);
    }
}
