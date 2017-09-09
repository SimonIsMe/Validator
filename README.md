# Validators

## How to use one validator?
```php
$validator = new IsEmailValidator();
$result = $validator->valid('email@gmail.com');

//  $result contains 0 when evrything is ok
//  or value > 1 otherwise

```

## How to check value with many validators?

`validThroughAllValidators()` method checks given value in ALL validators.
```php
$collection = new ValidatorsCollection(
    [
        new IsNotNullValidator(),
        new IsEmailValidator(),
    ]
);

$result = $collection->validThroughAllValidators('email@gmail.com');

$result->isValid();     // returns true if value is passed thought all validators
$result->errors();      // returns array of error numbers for each of not-passed validators

```

`validToFirstError()` method checks given value in all validators TO FIRST FAIL.
```php
$collection = new ValidatorsCollection(
    [
        new IsNotNullValidator(),
        new IsEmailValidator(),
    ]
);

$result = $collection->validToFirstError('email@gmail.com');

$result->isValid();     // returns true if value is passed thought all validators
$result->errors();      // returns array of error numbers (in this case there will be only single element in array) for each of not-passed validators

```

## How to check array of values?
You can create array full of validators. This array can contain nested validators arrays:
```php
$validators = [
    "email" => new IsEmailValidator(),
    "age" => new IsNumberValidator()
];
```

This $validators array can be used to validate $data array:
```php
$data = [
    "email" => "incorrect email address",
    "age" => 35
];

$arrayValidator = mew ArrayValidator(); 
$result = $arrayValidator->validateArray($validators, $data);
```

`$result` variable contains `ValidationResult` objects. 
`ValidationResult::errors()` returns nested array with error codes.

For more example look into ./tests/unit/ArrayValidatorTest.php


## LIST OF VALIDATORS
- IsBoolValidator
- IsDateTimeValidator
- IsDateValidator
- IsEmailValidator
- IsNotNullValidator
- IsNullValidator
- IsNumberEqualValidator
- IsNumberGreaterOrEqualValidator
- IsNumberGreaterThanValidator
- IsNumberInExclusiveRangeValidator
- IsNumberInInclusiveRangeValidator
- IsNumberLessOrEqualValidator
- IsNumberLessThanValidator
- IsNumberValidator
- IsStringValidator
- IsTimeValidator
- IsUrlValidator
- StringLengthValidator


## License

MIT (https://en.wikipedia.org/wiki/MIT_License)
