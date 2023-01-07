<?php

declare(strict_types=1);

namespace App\Http\Controllers\API;

use App\Http\Resources\ErrorResource;
use App\Models\User;
use App\Services\ModuleNumber\Resolvers\ModuleNumberResolver;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

abstract class AbstractAPIController
{
    public function generateDateTime(string $date): Carbon
    {
        $time = (new Carbon())->toTimeString();

        return new Carbon(\sprintf('%s %s', $date, $time));
    }

    public function generateNumber(
        string $table,
        string $key,
        string $column,
        bool $withYear = true
    ): string {
        $resolver = new ModuleNumberResolver();

        return $resolver->resolve($table, $key, $column, $withYear);
    }

    public function getUser(): ?User
    {
        /** @var User $user */
        $user = auth()->user();

        return $user;
    }

    /**
     * Return HTTP OK (200) response
     *
     * @param  mixed[]  $data
     * @param  mixed[]  $headers
     */
    protected function respondOk(array $data = [], ?array $headers = []): JsonResponse
    {
        return new JsonResponse($data, ResponseAlias::HTTP_OK, $headers);
    }

    /**
     * Return HTTP bad request (400) response
     *
     * @param  mixed[]  $data
     * @param  mixed[]  $headers
     */
    protected function respondBadRequest(array $data = [], ?array $headers = []): ErrorResource
    {
        return $this->respondError($data['message'], ResponseAlias::HTTP_BAD_REQUEST);
    }

    protected function respondConflict(string $message): JsonResource
    {
        return $this->respondError($message, ResponseAlias::HTTP_CONFLICT);
    }

    /**
     * Return HTTP created (201) response
     *
     * @param  mixed[]  $data
     * @param  mixed[]  $headers
     */
    protected function respondCreated(array $data = [], ?array $headers = []): JsonResponse
    {
        return new JsonResponse($data, ResponseAlias::HTTP_CREATED, $headers);
    }

    protected function respondInternalError(string $message): ErrorResource
    {
        return $this->respondError($message, ResponseAlias::HTTP_INTERNAL_SERVER_ERROR);
    }

    protected function respondForbidden(?string $message, ?array $headers = []): ErrorResource
    {
        return $this->respondError(
            $message ?? 'You do not have permission to access this.',
            ResponseAlias::HTTP_FORBIDDEN, $headers
        );
    }

    /**
     * Return HTTP no content (204) response
     *
     * @param  mixed[]  $headers
     */
    protected function respondNoContent(?array $headers = []): JsonResponse
    {
        return new JsonResponse([], ResponseAlias::HTTP_NO_CONTENT, $headers);
    }

    /**
     * Return HTTP not found (404) response
     *
     * @param  mixed[]  $headers
     */
    protected function respondNotFound(string $message, ?array $headers = []): ErrorResource
    {
        return $this->respondError($message, ResponseAlias::HTTP_NOT_FOUND);
    }

    /**
     * Return HTTP unauthorized (401) response
     *
     * @param  mixed[]  $data
     * @param  mixed[]  $headers
     */
    protected function respondUnauthorised(?array $headers = []): ErrorResource
    {
        return $this->respondError(
            'Invalid Credentials',
            ResponseAlias::HTTP_UNAUTHORIZED
        );
    }

    /**
     * Return HTTP unprocessable (422) response
     */
    protected function respondUnprocessable(string $message): JsonResource
    {
        return $this->respondError($message, ResponseAlias::HTTP_UNPROCESSABLE_ENTITY);
    }

    private function respondError(string $message, ?int $status = null): ErrorResource
    {
        return new ErrorResource($message, $status);
    }
}
