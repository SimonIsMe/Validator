<?php

namespace Validator;

use PHPUnit\Framework\TestCase;
use Tests\helpers\StubValidator;

class ArrayValidatorTest extends TestCase
{
	/**
	 * @dataProvider validateJson_dataProvider
	 */
	public function test_validateJson($validators, $data, $validateThroughAllValidators, $isValid, $errorCodes, $errorTexts)
	{
		$arrayValidator = new ArrayValidator();
		$result = $arrayValidator->validateArray($validators, $data, $validateThroughAllValidators);

		$this->assertEquals($isValid, $result->isValid());
		$this->assertEquals($errorCodes, $result->errorCodes());
		$this->assertEquals($errorTexts, $result->errorsTexts());
	}

	public function validateJson_dataProvider()
	{
		return [
			[
				[],
				[],
				true,
				true,
				[],
				[],
			],
			[
				[],
				[],
				false,
				true,
				[],
				[],
			],
			[
				[],
				['extra' => 'extra'],
				true,
				true,
				[],
				[],
			],
			[
				[],
				['extra' => 'extra'],
				false,
				true,
				[],
				[],
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
				],
				[],
				true,
				false,
				[
					'first' => ArrayValidator::NOT_EXISTS
				],
				[
					'first' => 'This value does not exist.'
				]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
				],
				[],
				false,
				false,
				[
					'first' => ArrayValidator::NOT_EXISTS
				],
				[
					'first' => 'This value does not exist.'
				]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
				],
				[
					'first' => []
				],
				true,
				false,
				[
					'first' => ArrayValidator::IS_ARRAY
				],
				[
					'first' => 'This value has to be a single value.'
				]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
				],
				[
					'first' => []
				],
				false,
				false,
				[
					'first' => ArrayValidator::IS_ARRAY
				],
				[
					'first' => 'This value has to be a single value.'
				]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
					'second' => new StubValidator(0, 'second_validator'),
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'third' => 'ok value',
					'first' => 'ok value',
					'second' => 'ok value',
				],
				true,
				true,
				[],
				[]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
					'second' => new StubValidator(0, 'second_validator'),
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'third' => 'ok value',
					'first' => 'ok value',
					'second' => 'ok value',
				],
				false,
				true,
				[],
				[]
			],
			[
				[
					'first' => new ValidatorsCollection([
						new StubValidator(0, 'first_validator_0'),
						new StubValidator(0, 'first_validator_1'),
					]),
					'second' => new StubValidator(0, 'second_validator')
				],
				[
					'first' => 'ok value',
					'second' => 'ok value',
				],
				true,
				true,
				[],
				[]
			],
			[
				[
					'first' => new ValidatorsCollection([
						new StubValidator(0, 'first_validator_0'),
						new StubValidator(0, 'first_validator_1'),
					]),
					'second' => new StubValidator(0, 'second_validator')
				],
				[
					'first' => 'ok value',
					'second' => 'ok value',
				],
				false,
				true,
				[],
				[]
			],
			[
				[
					'first' => new ValidatorsCollection([
						new StubValidator(0, 'first_validator_0'),
						new StubValidator(1, 'first_validator_1'),
					]),
					'second' => new StubValidator(0, 'second_validator')
				],
				[
					'first' => 'incorrect value',
					'second' => 'ok value',
				],
				true,
				false,
				[
					'first' => [
						'first_validator_1' => 1
					]
				],
				[
					'first' => [
						'first_validator_1' => '1'
					]
				]
			],
			[
				[
					'first' => new ValidatorsCollection([
						new StubValidator(0, 'first_validator_0'),
						new StubValidator(1, 'first_validator_1'),
					]),
					'second' => new StubValidator(0, 'second_validator')
				],
				[
					'first' => 'incorrect value',
					'second' => 'ok value',
				],
				false,
				false,
				[
					'first' => [
						'first_validator_1' => 1
					]
				],
				[
					'first' => [
						'first_validator_1' => '1'
					]
				]
			],
			[
				[
					'first' => new ValidatorsCollection([
						new StubValidator(2, 'first_validator_2'),
						new StubValidator(1, 'first_validator_1'),
					]),
					'second' => new StubValidator(0, 'second_validator')
				],
				[
					'first' => 'incorrect value',
					'second' => 'ok value',
				],
				true,
				false,
				[
					'first' => [
						'first_validator_2' => 2,
						'first_validator_1' => 1
					]
				],
				[
					'first' => [
						'first_validator_2' => '2',
						'first_validator_1' => '1'
					]
				]
			],
			[
				[
					'first' => new ValidatorsCollection([
						new StubValidator(2, 'first_validator_2'),
						new StubValidator(1, 'first_validator_1'),
					]),
					'second' => new StubValidator(0, 'second_validator')
				],
				[
					'first' => 'incorrect value',
					'second' => 'ok value',
				],
				false,
				false,
				[
					'first' => [
						'first_validator_2' => 2
					]
				],
				[
					'first' => [
						'first_validator_2' => '2'
					]
				]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
					'second' => new StubValidator(1, 'second_validator'),
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'third' => 'ok value',
					'first' => 'ok value',
					'second' => 'incorrect value',
				],
				true,
				false,
				[
					'second' => 1
				],
				[
					'second' => '1'
				]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
					'second' => new StubValidator(1, 'second_validator'),
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'third' => 'ok value',
					'first' => 'ok value',
					'second' => 'incorrect value',
				],
				false,
				false,
				[
					'second' => 1
				],
				[
					'second' => '1'
				]
			],
			[
				[
					'first' => new StubValidator(1, 'first_validator'),
					'second' => new StubValidator(2, 'second_validator'),
					'third' => new StubValidator(3, 'third_validator'),
				],
				[
					'third' => 'incorrect value',
					'first' => 'incorrect value',
					'second' => 'incorrect value',
				],
				true,
				false,
				[
					'first' => 1,
					'second' => 2,
					'third' => 3,
				],
				[
					'first' => '1',
					'second' => '2',
					'third' => '3',
				]
			],
			[
				[
					'first' => new StubValidator(1, 'first_validator'),
					'second' => new StubValidator(2, 'second_validator'),
					'third' => new StubValidator(3, 'third_validator'),
				],
				[
					'third' => 'incorrect value',
					'first' => 'incorrect value',
					'second' => 'incorrect value',
				],
				false,
				false,
				[
					'first' => 1,
					'second' => 2,
					'third' => 3,
				],
				[
					'first' => '1',
					'second' => '2',
					'third' => '3',
				]
			],

			//  nested
			[
				[
					'nested' => [],
					'first' => new StubValidator(0, 'first_validator'),
					'second' => new StubValidator(0, 'second_validator'),
				],
				[
					'nested' => [
					],
					'second' => 'ok value',
					'first' => 'ok value',
				],
				true,
				true,
				[],
				[]
			],
			[
				[
					'nested' => [],
					'first' => new StubValidator(0, 'first_validator'),
					'second' => new StubValidator(0, 'second_validator'),
				],
				[
					'nested' => [
					],
					'second' => 'ok value',
					'first' => 'ok value',
				],
				false,
				true,
				[],
				[]
			],
			[
				[
					'nested' => [],
					'first' => new StubValidator(1, 'first_validator'),
					'second' => new StubValidator(2, 'second_validator'),
				],
				[
					'nested' => [
					],
					'second' => 'incorrect value',
					'first' => 'incorrect value',
				],
				true,
				false,
				[
					'second' => 2,
					'first' => 1,
				],
				[
					'second' => '2',
					'first' => '1',
				]
			],
			[
				[
					'nested' => [],
					'first' => new StubValidator(1, 'first_validator'),
					'second' => new StubValidator(2, 'second_validator'),
				],
				[
					'nested' => [
					],
					'second' => 'incorrect value',
					'first' => 'incorrect value',
				],
				false,
				false,
				[
					'second' => 2,
					'first' => 1,
				],
				[
					'second' => '2',
					'first' => '1',
				]
			],
			[
				[
					'nested' => [
						'first' => new StubValidator(0, 'first_validator'),
						'second' => new StubValidator(0, 'second_validator'),
					],
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'nested' => [
						'first' => 'ok value',
						'second' => 'ok value',
					],
					'third' => 'ok value',
				],
				true,
				true,
				[],
				[]
			],
			[
				[
					'nested' => [
						'first' => new StubValidator(0, 'first_validator'),
						'second' => new StubValidator(0, 'second_validator'),
					],
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'nested' => [
						'first' => 'ok value',
						'second' => 'ok value',
					],
					'third' => 'ok value',
				],
				false,
				true,
				[],
				[]
			],
			[
				[
					'nested' => [
						'first' => new StubValidator(1, 'first_validator'),
						'second' => new StubValidator(0, 'second_validator'),
					],
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'nested' => [
						'first' => 'incorrect value',
						'second' => 'ok value',
					],
					'third' => 'ok value',
				],
				true,
				false,
				[
					'nested' => [
						'first' => 1,
					]
				],
				[
					'nested' => [
						'first' => '1',
					]
				]
			],
			[
				[
					'nested' => [
						'first' => new StubValidator(1, 'first_validator'),
						'second' => new StubValidator(0, 'second_validator'),
					],
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'nested' => [
						'first' => 'incorrect value',
						'second' => 'ok value',
					],
					'third' => 'ok value',
				],
				false,
				false,
				[
					'nested' => [
						'first' => 1,
					]
				],
				[
					'nested' => [
						'first' => '1',
					]
				]
			],
			[
				[
					'nested' => [
						'first' => new StubValidator(1, 'first_validator'),
						'second' => new StubValidator(0, 'second_validator'),
					],
					'third' => new StubValidator(3, 'third_validator'),
				],
				[
					'nested' => [
						'first' => 'incorrect value',
						'second' => 'ok value',
					],
					'third' => 'incorrect value',
				],
				true,
				false,
				[
					'nested' => [
						'first' => 1,
					],
					'third' => 3
				],
				[
					'nested' => [
						'first' => '1',
					],
					'third' => '3'
				]
			],


			[
				[
					'key' =>
						new ValidatorsCollection([
							new IsSetValidator(),
							new SetValidator([
								new IsStringValidator(),
							]),
						])
				],
				[
					'key' => ['a', 'b', 'c']
				],
				true,
				true,
				[],
				[],
			],
			[
				[
					'key' =>
						new ValidatorsCollection([
							new IsSetValidator(),
							new SetValidator([
								new IsStringValidator(),
							]),
						])
				],
				[
					'key' => ['a', 'b', 'c', 123]
				],
				true,
				false,
				[
					'key' => [
						'SetValidator' => 1
					]
				],
				[
					'key' => [
						'SetValidator' => 'Values in the set are incorrect.'
					]
				],
			],
			[
				[
					'nested' => [
						'key' =>
							new ValidatorsCollection([
								new IsSetValidator(),
								new SetValidator([
									new IsStringValidator(),
								]),
							]),
					],
					'third' => new StubValidator(0, 'third_validator'),
				],
				[
					'nested' => [
						'key' => ['a', 'b', 'c']
					],
					'third' => 'aaa'
				],
				true,
				true,
				[],
				[],
			],
			[
				[
					'nested' => [
						'key' =>
							new ValidatorsCollection([
								new IsSetValidator(),
								new SetValidator([
									new IsStringValidator(),
								]),
							]),
					],
					'third' => new StubValidator(3, 'third_validator'),
				],
				[
					'nested' => [
						'key' => ['a', 'b', 'c', 123]
					],
					'third' => 'aa'
				],
				true,
				false,
				[
					'nested' => [
						'key' => [
							'SetValidator' => 1
						]
					],
					'third' => 3
				],
				[
					'nested' => [
						'key' => [
							'SetValidator' => 'Values in the set are incorrect.'
						]
					],
					'third' => '3'
				],
			],
		];
	}
}
