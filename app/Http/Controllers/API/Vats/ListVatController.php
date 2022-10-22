<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Vats;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Vat;
use Illuminate\Http\Resources\Json\JsonResource;

final class ListVatController extends AbstractAPIController
{
    public function __invoke(): JsonResource
    {
        return new JsonResource(Vat::all());
    }
}
