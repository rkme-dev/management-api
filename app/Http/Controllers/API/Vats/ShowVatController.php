<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Vats;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Vat;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowVatController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        return new JsonResource(Vat::find($id));
    }
}
