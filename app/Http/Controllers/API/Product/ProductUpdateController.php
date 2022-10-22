<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Product;

use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

final class ProductUpdateController extends AbstractAPIController
{
    public function __invoke(ProductUpdateRequest $request, string $id): JsonResponse
    {
        $product = Product::find($id);

        $data = $request->all();

        $data['slug'] = Str::slug($request->get('name'));

        $product->update($data);

        return $this->respondOk([
            'data' => $product,
        ]);
    }
}
