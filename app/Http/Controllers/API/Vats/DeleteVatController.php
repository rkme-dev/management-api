<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Vats;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Vat;
use Illuminate\Http\Resources\Json\JsonResource;

final class DeleteVatController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        $vat = Vat::find($id);

        $vat->update([
            'is_active' => 0,
        ]);

        return new JsonResource(Vat::all());
    }
}
