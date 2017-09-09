<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsIntegerValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsIntegerValidator();
		$this->assertEquals('IsIntegerValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsIntegerValidator();
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
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
			[
				false,
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
			[
				0,
				IsIntegerValidator::IS_INTEGER,
				'Ok'
			],
			[
				-123,
				IsIntegerValidator::IS_INTEGER,
				'Ok'
			],
			[
				'-123',
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
			[
				'123',
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
			[
				'123.123',
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
			[
				123.123,
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
			[
				'',
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
			[
				'abc',
				IsIntegerValidator::IS_NOT_INTEGER,
				'Given value has to be an integer.'
			],
		];
	}
}
