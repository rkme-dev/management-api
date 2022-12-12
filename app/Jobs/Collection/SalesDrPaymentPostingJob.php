<?php

declare(strict_types=1);

namespace App\Jobs\Collection;

use App\Models\SalesDrPayment;
use App\Services\Collections\Interfaces\SalesDrPaymentResolverInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

final class SalesDrPaymentPostingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private int $salesDrPaymentId;

    public function __construct(int $salesDrPaymentId)
    {
        $this->salesDrPaymentId = $salesDrPaymentId;
    }

    public function handle(
        SalesDrPaymentResolverInterface $salesDrPaymentResolver
    ): void {
        $salesDrPayment = SalesDrPayment::where('id', $this->salesDrPaymentId)->first();

        if ($salesDrPayment === null) {
            return;
        }

        $salesDrPaymentResolver->resolve($salesDrPayment);
    }
}
