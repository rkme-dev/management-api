<?php

declare(strict_types=1);

namespace App\Services\Utils;

final class CollectorHelper
{
    /**
     * @param iterable<mixed> $items
     *
     * @return mixed[]
     */
    public static function convertToArray(iterable $items): array
    {
        return $items instanceof \Traversable ? \iterator_to_array($items) : $items;
    }

    /**
     * @param iterable<mixed> $items
     *
     * @return iterable<mixed>
     *
     * @throws \Exception
     */
    public static function ensureClass(iterable $items, string $class): iterable
    {
        foreach ($items as $item) {
            if (($item instanceof $class) === false) {
                throw new \Exception(\sprintf(
                    'Instance of %s expected, %s given',
                    $class,
                    \is_object($item) === false ? \gettype($item) : \get_class($item)
                ));
            }

            yield $item;
        }
    }

    /**
     * @param iterable<mixed> $items
     *
     * @return mixed[]
     */
    public static function ensureClassAsArray(iterable $items, string $class): array
    {
        return self::convertToArray(self::ensureClass($items, $class));
    }

    /**
     * @param iterable<mixed> $items
     * @param class-string $class
     *
     * @return mixed[]
     */
    public static function filterByClassAsArray(iterable $items, string $class): array
    {
        return self::convertToArray(self::filterByClass($items, $class));
    }

    /**
     * @param iterable<mixed> $items
     *
     * @return iterable<mixed>
     */
    public static function filterByClass(iterable $items, string $class): iterable
    {
        foreach ($items as $item) {
            if ($item instanceof $class) {
                yield $item;
            }
        }
    }
}
