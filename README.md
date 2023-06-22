![RichBuilds.com Components](/src/richbuilds_logo.png)

# 🛡 Guard

A set of runtime guard methods for PHP 8.1 by [RichBuilds](https://www.richbuilds.com).

<details>
<summary>inRange(mixed $value, mixed $min, mixed $max): void</summary>

| Parameter | Type  | Description                                   |
|-----------|-------|-----------------------------------------------|
| `$value`  | mixed | The value to check if it is within the range. |
| `$min`    | mixed | The minimum value of the range.               |
| `$max`    | mixed | The maximum value of the range.               |

### Throws

- `GuardException`: Throws a `GuardException` if the value is out of range.

### Returns

- `void`


---

This method checks if the given `$value` is within the range defined by `$min` 
and `$max`. It throws a `GuardException` if the value is out of range.

Example usage:

```php
try {
    $value = 5;
    $min = 0;
    $max = 10;

    Guard::inRange($value, $min, $max);
    // $result is true

    // Other code to handle the value within the range
} catch (GuardException $e) {
    // Handle the out of range value
}
```

Make sure to handle the `GuardException` to handle the case when the value is out of range.
</details>

<details>
<summary>isArrayShape(array $array, array $shape, string $chain = ''): bool</summary>

| Parameter | Type                   | Description                                           |
|-----------|------------------------|-------------------------------------------------------|
| `$array`  | `array<string, mixed>` | The array to check if it matches the specified shape. |
| `$shape`  | `array<string, mixed>` | The shape to match the array against.                 |
| `$chain`  | `string`               | (Optional) The chain of keys for nested arrays.       |

### Throws

- `GuardException`: Throws a `GuardException` if the array does not match the shape.

### Returns

- `void`


---

This method checks if the given `$array` matches the shape described by the `$shape` array. It iterates over the keys of both arrays and performs the following checks:

- If a key exists in `$array` but not in `$shape`, it throws a `GuardException` with an "invalid" error message.
- If a key exists in `$shape` but not in `$array`, it throws a `GuardException` with a "missing" error message.
- If the value associated with a key in `$array` is an array and the value associated with the same key in `$shape` is also an array, the method recursively calls itself to check if the nested arrays match.
- If the value associated with a key in `$array` is not of the same type as the value associated with the same key in `$shape`, it throws a `GuardException` with a "type mismatch" error message.

Example usage:

```php
try {
    $array = [
        'name' => 'John',
        'age' => 25,
    ];

    $shape = [
        'name' => 'string',
        'age' => 'integer',
    ];

    $result = YourClass::isArrayShape($array, $shape);
    // $result is true

    // Other code to handle the array matching the shape
} catch (GuardException $e) {
    // Handle the error when the array does not match the shape
}
```

Make sure to handle the `GuardException` to handle the case when the array does not match the shape.
</details>