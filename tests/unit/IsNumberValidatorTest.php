<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberValidator();
		$this->assertEquals('IsNumberValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNumberValidator();
		$result = $validator->valid($value);
		$this->assertEquals($expectedResult, $result);
		$this->assertEquals($expectedErrorMessage, $validator->errorText($result));
	}

	/**
	 * @return array
	 */
	public function dataProvider()
	{
		return [
			[
				true,
				IsNumberValidator::IS_NOT_NUMBER,
				'Given value has to be a number.'
			],
			[
				false,
				IsNumberValidator::IS_NOT_NUMBER,
				'Given value has to be a number.'
			],
			[
				0,
				IsNumberValidator::IS_NUMBER,
				'Ok'
			],
			[
				-123,
				IsNumberValidator::IS_NUMBER,
				'Ok'
			],
			[
				'-123',
				IsNumberValidator::IS_NUMBER,
				'Ok'
			],
			[
				'123',
				IsNumberValidator::IS_NUMBER,
				'Ok'
			],
			[
				'123.123',
				IsNumberValidator::IS_NUMBER,
				'Ok'
			],
			[
				123.123,
				IsNumberValidator::IS_NUMBER,
				'Ok'
			],
			[
				'',
				IsNumberValidator::IS_NOT_NUMBER,
				'Given value has to be a number.'
			],
			[
				'abc',
				IsNumberValidator::IS_NOT_NUMBER,
				'Given value has to be a number.'
			],
		];
	}
}
