<?php
declare(strict_types=1);

namespace Richbuilds\Guard\Tests;

use Richbuilds\Guard\Guard;
use PHPUnit\Framework\TestCase;
use Richbuilds\Guard\GuardException;

/**
 *
 */
class GuardIsArrayShapeTest extends TestCase
{

    /**
     * @dataProvider isArrayShapeDataProvider
     *
     * @param array<string, mixed> $array
     * @param array<string, mixed> $shape
     * @param bool $expectedResult
     * @param string $expectedExceptionMessage
     *
     * @throws GuardException
     */
    public function testIsArrayShape(
        array $array,
        array $shape,
        bool $expectedResult,
        string $expectedExceptionMessage
    ): void {
        if ($expectedExceptionMessage !== '') {
            static::expectException(GuardException::class);
            static::expectExceptionMessage($expectedExceptionMessage);
        }

        $result = Guard::isArrayShape($array, $shape);

        static::assertSame($expectedResult, $result);
    }

    /**
     * @return array<int, array{array<string, mixed>, array<string, mixed>, bool, string}>
     */
    public static function isArrayShapeDataProvider(): array
    {
        return [
            // valid:
            [
                ['name' => 'John Doe', 'age' => 30, 'email' => 'johndoe@example.com'],
                ['name' => 'string', 'age' => 'int', 'email' => 'string'],
                true,
                '',
            ],
            [
                ['address' => ['street' => '123 Main St', 'city' => 'New York', 'zip' => '10001']],
                ['address' => ['street' => 'string', 'city' => 'string', 'zip' => 'string']],
                true,
                '',
            ],

            // invalid:
            [
                ['foo' => 'bar'],
                ['key'=>'string'],
                false,
                'foo is invalid',
            ],
            [
                ['address' => ['street' => '123 Main St', 'city' => 'New York']],
                ['address' => ['street' => 'string', 'city' => 'string', 'zip' => 'string']],
                false,
                'address.zip is missing',
            ],
            [
                ['address' => ['street' => '123 Main St', 'city' => 'New York', 'zip'=>1]],
                ['address' => ['street' => 'string', 'city' => 'string', 'zip' => 'string']],
                false,
                'address.zip should be string got, int',
            ],
        ];
    }
}
