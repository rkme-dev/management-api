<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Supplier;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Supplier\SupplierCreateRequest;
use App\Models\Supplier;

final class SupplierCreateController extends AbstractAPIController
{
    public function __invoke(SupplierCreateRequest $request)
    {
        try {
            $data = $request->all(
                'name',
                'contact_person',
                'address',
                'bank_account_address',
                'bank_account_no',
                'bank_name',
            );

            $data['active'] = true;

            /** @var Supplier $supplier */
            $supplier = Supplier::create($data);

            if (\count($request->get('product_ids') ?? []) === 0) {
                return $this->respondCreated([
                    'data' => $supplier,
                ]);
            }

            $supplier->products()->sync($request->get('product_ids'));

            $supplier->save();

            $supplier->products;

            return $this->respondCreated([
                'data' => $supplier,
            ]);
        } catch (\Throwable $exception) {
            return $this->respondInternalError($exception->getMessage());
        }
    }
}
