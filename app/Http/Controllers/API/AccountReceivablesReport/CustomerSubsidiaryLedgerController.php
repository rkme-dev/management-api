<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AccountReceivablesReport;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Collection;
use App\Models\Customer;
use App\Models\OrderItem;
use App\Models\SalesOrder;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

final class CustomerSubsidiaryLedgerController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $salesOrders = SalesOrder::where('customer_id', $id)
            ->with('document')
            ->where('status', 'posted')
            ->get();

        $collections = Collection::where('customer_id', $id)
            ->with('document')
            ->where('status', 'posted')
            ->get();

        $orders = [
            ...$salesOrders,
            ...$collections
        ];

        $result = new \Illuminate\Support\Collection();

        foreach($orders as $order) {
            $source = ($order instanceof SalesOrder === true) ? 'Sales' : 'Collection';

            $orderNumber = $source === 'Sales' ? $order->getAttribute('sales_order_number') :
                $order->getAttribute('collection_order_number');

            $result->push([
                'order_number' => $orderNumber,
                'date_posted' => (new Carbon($order->getAttribute('date_posted')))->toDateString(),
                'source' => $source,
                'document' => $order->document->getAttribute('document_name'),
                'amount' => number_format((float)$order->getAttribute('amount'), 2),
                'currency' => 'PHP',
            ]);
        }

        return new JsonResource($result->sortByDesc('date_posted'));
    }
}
