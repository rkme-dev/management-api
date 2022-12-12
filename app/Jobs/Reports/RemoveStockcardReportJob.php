<?php

declare(strict_types=1);

namespace App\Jobs\Reports;

use App\Models\StockcardReport;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class RemoveStockcardReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public string $type,
        public int $typeId
    ) {
    }

    public function handle(): void
    {
        $stockcard = StockcardReport::where('morphable_id', $this->typeId)->where('morphable_type', $this->type)->first();

        if ($stockcard === null) {
            return;
        }

        $stockcard->delete();
    }
}
