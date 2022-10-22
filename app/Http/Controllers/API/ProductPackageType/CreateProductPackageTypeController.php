<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\ProductPackageType;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\ProductPackageType\CreateProductPackageTypeRequest;
use App\Models\Product;
use App\Models\ProductPackageType;
use Illuminate\Http\Resources\Json\JsonResource;

final class CreateProductPackageTypeController extends AbstractAPIController
{
    public function __invoke(CreateProductPackageTypeRequest $request, int $id): JsonResource
    {
        $product = Product::find($id);

        if ($product === null) {
            return $this->respondNotFound('Product not found');
        }

        $data = [
            ...$request->all('name', 'quantity'),
            ...[
                'product_id' => $product->id,
                'created_by' => $this->getUser()->getId(),
            ],
        ];

        return new JsonResource([
            'data' => ProductPackageType::create($data),
        ]);
    }
}
