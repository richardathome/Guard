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
     * @param string $expectedExceptionMessage
     *
     * @throws GuardException
     */
    public function testIsArrayShape(
        array $array,
        array $shape,
        string $expectedExceptionMessage
    ): void {

        if ($expectedExceptionMessage !== '') {
            static::expectException(GuardException::class);
            static::expectExceptionMessage($expectedExceptionMessage);
        }

        Guard::isArrayShape($array, $shape);

        if ($expectedExceptionMessage === '') {
            static::assertTrue(true);
        }

    }

    /**
     * @return array<int, array{array<string, mixed>, array<string, mixed>, string}>
     */
    public static function isArrayShapeDataProvider(): array
    {
        return [
            // valid:
            [
                ['name' => 'John Doe', 'age' => 30, 'email' => 'johndoe@example.com'],
                ['name' => 'string', 'age' => 'int', 'email' => 'string'],
                '',
            ],
            [
                ['address' => ['street' => '123 Main St', 'city' => 'New York', 'zip' => '10001']],
                ['address' => ['street' => 'string', 'city' => 'string', 'zip' => 'string']],
                '',
            ],

            // invalid:
            [
                ['foo' => 'bar'],
                ['key'=>'string'],
                'foo is invalid',
            ],
            [
                ['address' => ['street' => '123 Main St', 'city' => 'New York']],
                ['address' => ['street' => 'string', 'city' => 'string', 'zip' => 'string']],
                'address.zip is missing',
            ],
            [
                ['address' => ['street' => '123 Main St', 'city' => 'New York', 'zip'=>1]],
                ['address' => ['street' => 'string', 'city' => 'string', 'zip' => 'string']],
                'address.zip should be string, got int',
            ],
        ];
    }
}
