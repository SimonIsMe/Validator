<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberGreaterThanValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult)
	{
		$validator = new IsNumberGreaterThanValidator($boundary);
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
				IsNumberGreaterThanValidator::NUMBER_IS_OK,
			],
			[
				20,
				20,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
			],
			[
				20,
				-10,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
			],
			[
				20.5,
				100,
				IsNumberGreaterThanValidator::NUMBER_IS_OK,
			],
			[
				20.5,
				20.5,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
			],
			[
				20.5,
				-10,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
			],
		];
	}
}
