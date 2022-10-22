<?php

declare(strict_types=1);

namespace App\Http\Controllers\API\Authentication;

use App\Http\Controllers\API\AbstractAPIController;
use App\Models\User;
use Illuminate\Http\Request;

final class LogoutController extends AbstractAPIController
{
    public function __invoke(Request $request)
    {
        /** @var User $user */
        $user = $this->getUser();

        $user->currentAccessToken()->delete();

        return $this->respondNoContent();
    }
}
