<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNotNullValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNotNullValidator();
		$this->assertEquals('IsNotNullValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNotNullValidator();
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
				IsNotNullValidator::VALUE_IS_NULL,
				'Given value can not be null.'
			],
			[
				123,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
			[
				0,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
			[
				123.456,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
			[
				0.0,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
			[
				'abc',
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
			[
				'',
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
			[
				true,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
			[
				false,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
				'Ok'
			],
		];
	}
}
