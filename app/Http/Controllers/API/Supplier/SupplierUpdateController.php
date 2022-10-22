<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Supplier;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Http\Requests\Supplier\SupplierUpdateRequest;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\JsonResponse;

final class SupplierUpdateController extends AbstractAPIController
{
    public function __invoke(SupplierUpdateRequest $request, string $id): JsonResponse
    {
        $supplier = Supplier::find($id);

        $data = $request->all(
            'name',
            'contact_person',
            'address',
            'bank_account_address',
            'bank_account_no',
            'bank_name',
        );

        if (\count($request->get('product_ids') ?? []) > 0) {
            $supplier->products()->sync($request->get('product_ids'));
            $supplier->save();
        }

        $supplier->update($data);
        $supplier->save();
        $supplier->products;

        return $this->respondCreated([
            'data' => $supplier,
        ]);
    }
}
