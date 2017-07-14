<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNotNullValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test_not_null($value, $expectedResult)
	{
		$validator = new IsNotNullValidator();
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
				IsNotNullValidator::VALUE_IS_NULL,
			],
			[
				123,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				0,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				123.456,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				0.0,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				'abc',
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				'',
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				true,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
			[
				false,
				IsNotNullValidator::VALUE_IS_NOT_NULL,
			],
		];
	}
}
