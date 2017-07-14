<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult)
	{
		$validator = new IsNumberValidator();
		$result = $validator->valid($value);
		$this->assertEquals($expectedResult, $result);
	}

	/**
	 * @return array
	 */
	public function dataProvider()
	{
		return [
			[
				123,
				IsNumberValidator::IS_NUMBER,
			],
			[
				(float) 123.456,
				IsNumberValidator::IS_NUMBER,
			],
			[
				(double) 123.456,
				IsNumberValidator::IS_NUMBER,
			],
			[
				'123',
				IsNumberValidator::IS_NUMBER,
			],
			[
				'123.456',
				IsNumberValidator::IS_NUMBER,
			],
			[
				'123,456',
				IsNumberValidator::IS_NOT_NUMBER,
			],
			[
				'123abc',
				IsNumberValidator::IS_NOT_NUMBER,
			],
			[
				'abc',
				IsNumberValidator::IS_NOT_NUMBER,
			],
			[
				'',
				IsNumberValidator::IS_NOT_NUMBER,
			],
			[
				true,
				IsNumberValidator::IS_NOT_NUMBER,
			],
			[
				false,
				IsNumberValidator::IS_NOT_NUMBER,
			],
		];
	}
}
