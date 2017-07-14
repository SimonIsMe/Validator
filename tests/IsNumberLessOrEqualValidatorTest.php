<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberLessOrEqualValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult)
	{
		$validator = new IsNumberLessOrEqualValidator($boundary);
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
				IsNumberLessOrEqualValidator::NUMBER_IS_TOO_BIG,
			],
			[
				20,
				20,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
			],
			[
				20,
				-10,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
			],
			[
				20.5,
				100,
				IsNumberLessOrEqualValidator::NUMBER_IS_TOO_BIG,
			],
			[
				20.5,
				20.5,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
			],
			[
				20.5,
				-10,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
			],
		];
	}
}
