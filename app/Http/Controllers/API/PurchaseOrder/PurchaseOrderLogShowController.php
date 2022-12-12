<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\PurchaseOrderLogs;
use Illuminate\Http\JsonResponse;

final class PurchaseOrderLogShowController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $logs = PurchaseOrderLogs::where(['order_id' => $id])->with('user')->get();

        foreach ($logs as $log) {
            $log['full_name'] = $log->user->getFullName();
            $log->unsetRelation('user');
        }

        return $this->respondOK($logs->toArray());
    }
}
