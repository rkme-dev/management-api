<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Supplier;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;

final class SupplierDeleteController extends AbstractAPIController
{
    public function __invoke(string $id): JsonResponse
    {
        $customer = Supplier::find($id);
        $customer->delete();

        return $this->respondNoContent();
    }
}
