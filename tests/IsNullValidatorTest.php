<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNullValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult)
	{
		$validator = new IsNullValidator();
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
				null,
				IsNullValidator::VALUE_IS_NULL,
			],
			[
				123,
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				0,
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				123.456,
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				0.0,
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				'abc',
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				'',
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				true,
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				false,
				IsNullValidator::VALUE_IS_NOT_NULL,
			],
		];
	}
}
