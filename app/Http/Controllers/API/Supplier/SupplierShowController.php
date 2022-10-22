<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Supplier;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;

final class SupplierShowController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $customer = Supplier::findOrFail($id);

        $customer->products;

        return $this->respondOK([
            'data' => $customer,
        ]);
    }
}
