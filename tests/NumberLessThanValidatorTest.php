<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class NumberLessThanValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult)
	{
		$validator = new NumberLessThanValidator($boundary);
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
				1,
			],
			[
				20,
				20,
				1,
			],
			[
				20,
				-10,
				0,
			],
			[
				20.5,
				100,
				1,
			],
			[
				20.5,
				20.5,
				1,
			],
			[
				20.5,
				-10,
				0,
			],
		];
	}
}
