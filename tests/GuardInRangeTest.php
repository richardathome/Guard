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
     * @param bool $expectedResult
     * @param string $expectedExceptionMessage
     *
     * @throws GuardException
     */
    public function testInRange(
        mixed $value,
        mixed $min,
        mixed $max,
        bool $expectedResult,
        string $expectedExceptionMessage
    ): void {

        if ($expectedExceptionMessage !== '') {
            static::expectException(GuardException::class);
            static::expectExceptionMessage($expectedExceptionMessage);
        }

        $result = Guard::inRange($value, $min, $max);

        if ($expectedExceptionMessage === '') {
            static::assertSame($expectedResult, $result);
        }
    }

    /**
     * @return array<int,array{mixed,mixed,mixed,bool,string}>
     */
    public static function inRangeDataProvider(): array
    {
        return [
            [5, 1, 10, true, ''],
            [5.5, 1, 10, true, ''],
            [15, 1, 10, false, 'value out of range'],
            [0, 1, 10, false, 'value out of range'],
            [10, 1, 10, true, ''],
            [1, 1, 10, true, ''],
        ];
    }
}
