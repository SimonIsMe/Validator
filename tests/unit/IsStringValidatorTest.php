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
	public function test($value, $expectedResult)
	{
		$validator = new IsStringValidator();
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
				true,
				IsStringValidator::IS_NOT_STRING
			],
			[
				false,
				IsStringValidator::IS_NOT_STRING
			],
			[
				0,
				IsStringValidator::IS_NOT_STRING
			],
			[
				-123,
				IsStringValidator::IS_NOT_STRING
			],
			[
				123.123,
				IsStringValidator::IS_NOT_STRING
			],
			[
				'',
				IsStringValidator::IS_STRING
			],
			[
				'abc',
				IsStringValidator::IS_STRING
			],
		];
	}
}
