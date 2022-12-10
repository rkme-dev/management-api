<?php

declare(strict_types=1);

namespace App\Helpers;

trait InitialisableTrait
{
    /**
     * Initialisable constructor.
     *
     * @param  mixed[]|null  $payload
     */
    public function __construct(?array $payload = [])
    {
        $this->initialiseAttributes($payload ?? []);
    }

    /**
     * Sets the instance attributes based on the give key value pairs
     *
     * @param  mixed[]  $payload
     */
    private function initialiseAttributes(array $payload): void
    {
        if (empty($payload) === true) {
            return;
        }
        foreach ($payload as $key => $value) {
            // Generate setter method name from key.
            $method = $this->getSetterMethodName((string) $key);

            if (\method_exists(self::class, $method) !== true) {
                continue;
            }

            $this->{$method}($value);
        }
    }

    /**
     * Convert snake case to camel case.
     */
    private function getSetterMethodName(string $key): string
    {
        $method = \str_replace('_', '', \ucwords($key, '_'));

        return \sprintf('set%s', \ucfirst($method));
    }
}
