<?php

declare(strict_types=1);

namespace App\Jobs\SalesDr;

use App\Jobs\Reports\RemoveStockcardReportJob;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class UnpostSalesDrJob implements ShouldQueue
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

        $remaining = (float) $unit->pivot->getAttribute('actual_balance') + (float) $orderItem->getAttribute('actual_quantity');

        $unit->pivot->setAttribute('actual_balance', $remaining);

        $unit->pivot->save();

        $unit->pivot->refresh();

        RemoveStockcardReportJob::dispatch(
            get_class($orderItem->salesDrItem->salesDr),
            $orderItem->salesDrItem->salesDr->getAttribute('id'),
        );
    }
}
