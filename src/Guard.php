<?php
declare(strict_types=1);


namespace Richbuilds\Guard;

/**
 *
 */
class Guard
{
    /**
     * Returns true if $value is between $min and $max
     *
     * @param mixed $value
     * @param mixed $min
     * @param mixed $max
     *
     * @return void
     *
     * @throws GuardException
     */
    public static function inRange(mixed $value, mixed $min, mixed $max): void
    {
        if ($value < $min || $value > $max) {
            throw new GuardException('value out of range');
        }
    }

    /**
     * Returns true if $array matches the shape described by $shape
     *
     * @param array<string, mixed> $array
     * @param array<string, mixed> $shape
     * @param string $chain
     *
     * @return void
     *
     * @throws GuardException
     */
    public static function isArrayShape(array $array, array $shape, string $chain = ''): void
    {
        $keys = array_unique(array_keys($array) + array_keys($shape));

        foreach ($keys as $key) {
            if (array_key_exists($key, $array) && !array_key_exists($key, $shape)) {
                throw new GuardException(sprintf('%s%s is invalid', $chain, $key));
            }

            if (!array_key_exists($key, $array)) {
                throw new GuardException(sprintf('%s%s is missing', $chain, $key));
            }

            $value = $array[$key];
            $type = get_debug_type($value);

            if (is_array($value) && is_array($shape[$key])) {
                static::isArrayShape($value, $shape[$key], $chain . $key . '.');
            } elseif ($type !== $shape[$key]) {
                throw new GuardException(sprintf('%s%s should be %s, got %s', $chain, $key, $shape[$key], $type));
            }
        }
    }
}
