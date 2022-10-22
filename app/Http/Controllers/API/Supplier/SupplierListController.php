<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Supplier;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

final class SupplierListController extends AbstractAPIController
{
    public function __invoke(Request $request): JsonResponse
    {
        $suppliers = $this->getSupplier($request);

        return $this->respondOK(
            [
                'data' => $suppliers,
            ]
        );
    }

    private function getSupplier(Request $request): Collection
    {
        if ($request->has('type') === true) {
            return Supplier::where('type', $request->get('type'));
        }

        return Supplier::all();
    }
}
