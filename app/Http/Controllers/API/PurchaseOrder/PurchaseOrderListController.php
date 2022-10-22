<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\PurchaseOrder;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\PurchaseOrder;
use Illuminate\Http\JsonResponse;

final class PurchaseOrderListController extends AbstractAPIController
{
    public function __invoke(): JsonResponse
    {
        $orders = PurchaseOrder::all();

        return $this->respondOK(
            [
                'data' => $orders,
            ]
        );
    }
}
