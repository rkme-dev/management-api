<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\PaymentLogs;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderLogs;
use Illuminate\Http\JsonResponse;

final class PurchaseOrderPaymentLogShowController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $logs = PaymentLogs::where(['orderable_id' => $id, 'orderable_type' => PurchaseOrder::class])->with('user')->get();

        foreach ($logs as $log) {
            $log['full_name'] = $log->user->getFullName();
            $log->unsetRelation('user');
        }

        return $this->respondOK($logs->groupBy('type')->toArray());
    }
}
