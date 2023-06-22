<?php
declare(strict_types=1);

namespace Richbuilds\Guard\Tests;

use Richbuilds\Guard\Guard;
use PHPUnit\Framework\TestCase;
use Richbuilds\Guard\GuardException;

/**
 *
 */
class GuardInRangeTest extends TestCase
{

    /**
     * @dataProvider inRangeDataProvider
     *
     * @param mixed $value
     * @param mixed $min
     * @param mixed $max
     * @param string $expectedExceptionMessage
     *
     * @throws GuardException
     */
    public function testInRange(
        mixed $value,
        mixed $min,
        mixed $max,
        string $expectedExceptionMessage
    ): void {

        if ($expectedExceptionMessage !== '') {
            static::expectException(GuardException::class);
            static::expectExceptionMessage($expectedExceptionMessage);
        }

        Guard::inRange($value, $min, $max);

        if ($expectedExceptionMessage === '') {
            static::assertTrue(true);
        }
    }

    /**
     * @return array<int,array{mixed,mixed,mixed,string}>
     */
    public static function inRangeDataProvider(): array
    {
        return [
            [5, 1, 10, ''],
            [5.5, 1, 10, ''],
            [11, 1, 10, 'value out of range'],
            [0, 1, 10, 'value out of range'],
            [10, 1, 10, ''],
            [1, 1, 10, ''],
        ];
    }
}
