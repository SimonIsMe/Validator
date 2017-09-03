<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberLessThanValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberLessThanValidator(12);
		$this->assertEquals('IsNumberLessThanValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult)
	{
		$validator = new IsNumberLessThanValidator($boundary);
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
				20,
				100,
				IsNumberLessThanValidator::NUMBER_IS_TOO_BIG,
			],
			[
				20,
				20,
				IsNumberLessThanValidator::NUMBER_IS_TOO_BIG,
			],
			[
				20,
				-10,
				IsNumberLessThanValidator::NUMBER_IS_OK,
			],
			[
				20.5,
				100,
				IsNumberLessThanValidator::NUMBER_IS_TOO_BIG,
			],
			[
				20.5,
				20.5,
				IsNumberLessThanValidator::NUMBER_IS_TOO_BIG,
			],
			[
				20.5,
				-10,
				IsNumberLessThanValidator::NUMBER_IS_OK,
			],
		];
	}
}
