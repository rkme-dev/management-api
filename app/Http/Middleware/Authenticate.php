<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class Authenticate extends Middleware
{
    protected function redirectTo($request): void
    {
        if (! $request->expectsJson()) {
            throw new HttpResponseException(
                new JsonResponse([
                    'error' => 'Unauthorized',
                ],
                    ResponseAlias::HTTP_UNAUTHORIZED
                )
            );
        }
    }
}
