<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsBoolValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsBoolValidator();
		$this->assertEquals('IsBoolValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsBoolValidator();
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
				IsBoolValidator::IS_BOOL,
				'Ok'
			],
			[
				false,
				IsBoolValidator::IS_BOOL,
				'Ok'
			],
			[
				0,
				IsBoolValidator::IS_NOT_BOOL,
				'Given value has to be a bool value.'
			],
			[
				-123,
				IsBoolValidator::IS_NOT_BOOL,
				'Given value has to be a bool value.'
			],
			[
				123.123,
				IsBoolValidator::IS_NOT_BOOL,
				'Given value has to be a bool value.'
			],
			[
				'',
				IsBoolValidator::IS_NOT_BOOL,
				'Given value has to be a bool value.'
			],
			[
				'abc',
				IsBoolValidator::IS_NOT_BOOL,
				'Given value has to be a bool value.'
			],
		];
	}
}
