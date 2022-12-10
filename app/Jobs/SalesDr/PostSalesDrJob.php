<?php

declare(strict_types=1);

namespace App\Jobs\SalesDr;

use App\Jobs\Reports\CreateStockcardReportJob;
use App\Models\OrderItem;
use App\Services\InventoryService\Resources\CreateStockcardResource;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class PostSalesDrJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
       public int $orderItemId
    ) {
    }

    public function handle(): void
    {
        $orderItem = OrderItem::find($this->orderItemId);

        $unit = $orderItem->product->units->where('name', $orderItem->getAttribute('unit'))->first();

        if ($unit === null) {
            return;
        }

        $remaining = (float) $unit->pivot->getAttribute('actual_balance') - (float) $orderItem->getAttribute('actual_quantity');

        $unit->pivot->setAttribute('actual_balance', $remaining);

        $unit->pivot->save();

        CreateStockcardReportJob::dispatch(new CreateStockcardResource([
            'event' => 'Sales',
            'type' => get_class($orderItem->salesDrItem->salesDr),
            'typeId' => $orderItem->salesDrItem->salesDr->getAttribute('id'),
            'productId' => $orderItem->getAttribute('product_id'),
            'date' => $orderItem->salesDrItem->salesDr->getAttribute('date_posted'),
            'document' => $orderItem->salesDrItem->salesDr->document->getAttribute('module'),
            'documentNumber' => $orderItem->salesDrItem->salesDr->document->getAttribute('document_name'),
            'remarks' => $orderItem->salesDrItem->salesDr->getAttribute('remarks'),
            'quantity' => $orderItem->getAttribute('actual_quantity'),
            'unit' => $orderItem->getAttribute('unit'),
            'price' => (string) $orderItem->getAttribute('total_amount'),
            'quantityIn' => '0',
            'quantityOut' => $orderItem->getAttribute('actual_quantity'),
            'balance' => (string) $remaining,
            'status' => 'posted',
        ]));
    }
}
