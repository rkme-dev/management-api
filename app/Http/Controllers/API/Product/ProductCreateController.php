<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Product;

use App\Enums\ProductTypeEnums;
use App\Http\Controllers\API\AbstractAPIController;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

final class ProductCreateController extends AbstractAPIController
{
    public function __invoke(ProductCreateRequest $request): JsonResponse
    {
        $product = \array_merge($request->all(), [
            'active' => true,
            'slug' => Str::slug($request->get('name')),
            'created_by' => $this->getUser()->getId(),
        ]);

        $newProduct = new ProductResource(Product::create($product));

        return $this->respondCreated((array)$newProduct);
    }
}
