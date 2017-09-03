<?php

namespace Validator;

use PHPUnit\Framework\TestCase;
use Tests\helpers\StubValidator;

class ArrayValidatorTest extends TestCase
{
	/**
	 * @dataProvider validateJson_dataProvider
	 */
	public function test_validateJson($validators, $data, $isValid, $errors)
	{
		$arrayValidator = new ArrayValidator();
		$result = $arrayValidator->validateArray($validators, $data);

		$this->assertEquals($isValid, $result->isValid());
		$this->assertEquals($errors, $result->errors());
	}

	public function validateJson_dataProvider()
	{
		return [
			[
				[],
				[],
				true,
				[]
			],[
				[],
				['extra' => 'extra'],
				true,
				[]
			],
			[
				[
					'first' => new StubValidator(0, 'first_validator'),
				],
				[],
				false,
				[
					'first' => ArrayValidator::NOT_EXISTS
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
				[
					'first' => ArrayValidator::IS_ARRAY
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
				[]
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
				[
					'second' => 1
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
				[
					'first' => 1,
					'second' => 2,
					'third' => 3,
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
				false,
				[
					'second' => 2,
					'first' => 1,
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
				false,
				[
					'nested' => [
						'first' => 1,
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
				false,
				[
					'nested' => [
						'first' => 1,
					],
					'third' => 3
				]
			],
		];
	}
}
