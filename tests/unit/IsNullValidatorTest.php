<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNullValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNullValidator();
		$this->assertEquals('IsNullValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNullValidator();
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
				null,
				IsNullValidator::VALUE_IS_NULL,
				'Ok'
			],
			[
				123,
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
			[
				0,
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
			[
				123.456,
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
			[
				0.0,
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
			[
				'abc',
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
			[
				'',
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
			[
				true,
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
			[
				false,
				IsNullValidator::VALUE_IS_NOT_NULL,
				'Given value has to be null.'
			],
		];
	}
}
