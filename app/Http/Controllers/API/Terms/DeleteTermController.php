<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Terms;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\Term;

final class DeleteTermController extends AbstractAPIController
{
    public function __invoke(int $id)
    {
        $term = Term::find($id);

        $term->update([
            'is_active' => 0,
        ]);

        return $this->respondNoContent();
    }
}
