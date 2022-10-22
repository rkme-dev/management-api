<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Terms;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Term;
use Illuminate\Http\Resources\Json\JsonResource;

final class ShowTermController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResource
    {
        return new JsonResource(Term::find($id));
    }
}
