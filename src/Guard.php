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
     * @return bool
     *
     * @throws GuardException
     */
    public static function inRange(mixed $value, mixed $min, mixed $max): bool
    {
        if ($value < $min || $value > $max) {
            throw new GuardException('value out of range');
        }

        return true;
    }

    /**
     * Returns true if $array matches the shape described by $shape
     *
     * @param array<string, mixed> $array
     * @param array<string, mixed> $shape
     * @param string $chain
     *
     * @return bool
     *
     * @throws GuardException
     */
    public static function isArrayShape(array $array, array $shape, string $chain = ''): bool
    {
        $keys = array_unique(array_keys($array) + array_keys($shape));

        foreach ($keys as $key) {
            if (array_key_exists($key, $array) && !array_key_exists($key, $shape)) {
                throw new GuardException($chain . $key . ' is invalid');
            }

            if (!array_key_exists($key, $array)) {
                throw new GuardException($chain . $key . ' is missing');
            }

            $value = $array[$key];
            $type = get_debug_type($value);

            if (is_array($value) && is_array($shape[$key])) {
                self::isArrayShape($value, $shape[$key], $chain . $key . '.');
            } elseif ($type !== $shape[$key]) {
                throw new GuardException($chain . $key . ' should be ' . $shape[$key] . ' got, ' . $type);
            }
        }

        return true;
    }
}
