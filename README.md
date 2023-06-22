## `inRange(mixed $value, mixed $min, mixed $max): bool`

Determines whether a value is between a specified minimum and maximum range.

This method checks if the given value is greater than or equal to the minimum value and less than or equal to the maximum value, indicating that it falls within the specified range.

### Parameters

| Parameter | Type  | Description                                   |
|-----------|-------|-----------------------------------------------|
| `$value`  | mixed | The value to check if it is within the range. |
| `$min`    | mixed | The minimum value of the range.               |
| `$max`    | mixed | The maximum value of the range.               |


### Return Value

- (bool): Returns `true` if the value is within the range; otherwise, `false`.

### Example

```php
$value = 5;
$min = 1;
$max = 10;

echo Guard::inRange(5, 1, 10); // true

echo Guard::inRange(0, 1, 10); // false
```

---
## `isArrayShape(array $array, array $shape): bool`

Determines whether an array matches the shape described by a given shape array.

This method validates if the provided array matches the expected structure defined by the shape array. It compares the keys and values of the array against the keys and corresponding types in the shape array to check for a match.

### Parameters

- `$array` (array&lt;string, mixed&gt;): The array to be validated against the shape.
- `$shape` (array&lt;string, mixed&gt;): The shape array describing the expected structure of the array.

### Return Value

- (bool): Returns `true` if the array matches the shape; otherwise, `false`.

### Examples

#### Example 1

```php
$user = [
    'name' => 'John Doe',
    'age' => 30,
    'email' => 'johndoe@example.com',
];

$shape = [
    'name' => 'string',
    'age' => 'integer',
    'email' => 'string',
];

if (Guard::isArrayShape($user, $shape)) {
    echo 'The array matches the shape.';
} else {
    echo 'The array does not match the shape.';
}
```

#### Example 2

```php
$address = [
    'street' => '123 Main St',
    'city' => 'New York',
    'zip' => '10001',
];

$shape = [
    'street' => 'string',
    'city' => 'string',
];

if (Guard::isArrayShape($address, $shape)) {
    echo 'The array matches the shape.';
} else {
    echo 'The array does not match the shape.';
}
```