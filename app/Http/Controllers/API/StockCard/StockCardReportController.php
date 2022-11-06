<?php

namespace App\Http\Controllers\API\StockCard;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\SalesDr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class StockCardReportController extends AbstractAPIController
{
    public function __invoke(Product $product): JsonResource
    {
        $items = OrderItem::with(['product', 'orderable.document'])
            ->whereHasMorph(
                'orderable',
                SalesDr::class,
                function (Builder $query) {
                    $query->where('status', 'posted');
                }
            )
            ->where('product_id', $product->id)
            ->get()
            ->map(function (OrderItem $item) {
                return [
                    'date' => (new Carbon($item->getAttribute('created_at')))->toDateString(),
                    'event' => $item->orderable->document->getAttribute('module'),
                    'document' => $item->orderable->document->getAttribute('document_name'),
                    'doc_number' => $item->orderable->document->getAttribute('description'),
                    'remarks' => $item->orderable->getAttribute('remarks'),
                    'quantity' => $item->getAttribute('quantity'),
                    'unit' => $item->getAttribute('unit'),
                    'price' => $item->getAttribute('price'),
                    'status' => $item->orderable->getAttribute('status'),
                    'quantity_in' => null,
                    'quantity_out' => $item->getAttribute('quantity'),
                    'balance' => $item->orderable->getAttribute('remaining_balance')
                ];
            });

        return new JsonResource($items);
    }
}
