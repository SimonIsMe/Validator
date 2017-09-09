<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsStringValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsStringValidator();
		$this->assertEquals('IsStringValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsStringValidator();
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
				IsStringValidator::IS_NOT_STRING,
				'Given value has to be a string.'
			],
			[
				false,
				IsStringValidator::IS_NOT_STRING,
				'Given value has to be a string.'
			],
			[
				0,
				IsStringValidator::IS_NOT_STRING,
				'Given value has to be a string.'
			],
			[
				-123,
				IsStringValidator::IS_NOT_STRING,
				'Given value has to be a string.'
			],
			[
				123.123,
				IsStringValidator::IS_NOT_STRING,
				'Given value has to be a string.'
			],
			[
				'',
				IsStringValidator::IS_STRING,
				'Ok'
			],
			[
				'abc',
				IsStringValidator::IS_STRING,
				'Ok'
			],
		];
	}
}
