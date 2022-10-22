<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\AccessLevel;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\AccessLevel;
use Illuminate\Http\JsonResponse;

final class AccessLevelDeleteController extends AbstractAPIController
{
    public function __invoke(int $id): JsonResponse
    {
        $accessLevel = AccessLevel::find($id);

        if ($accessLevel === null) {
            return $this->respondNoContent();
        }

        $accessLevel->delete();

        $accessLevel->updated_by = $this->getUser()->id;

        $accessLevel->save();

        return $this->respondNoContent();
    }
}
