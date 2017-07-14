<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class NumberInInclusiveRangeValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundaryLeft, $boundaryRight, $value, $expectedResult)
	{
		$validator = new NumberInInclusiveRangeValidator($boundaryLeft, $boundaryRight);
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
				-20,
				50,
				-100,
				NumberInInclusiveRangeValidator::VALUE_TOO_SMALL,
			],
			[
				-20,
				50,
				-20,
				NumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
			],
			[
				-20,
				50,
				0,
				NumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
			],
			[
				-20,
				50,
				50,
				NumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
			],
			[
				-20,
				50,
				100,
				NumberInInclusiveRangeValidator::VALUE_TOO_BIG,
			],
			[
				-20.0,
				50.0,
				-100,
				NumberInInclusiveRangeValidator::VALUE_TOO_SMALL,
			],
			[
				-20.0,
				50.0,
				-20,
				NumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
			],
			[
				-20.0,
				50.0,
				0,
				NumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
			],
			[
				-20.0,
				50.0,
				50,
				NumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
			],
			[
				-20.0,
				50.0,
				100,
				NumberInInclusiveRangeValidator::VALUE_TOO_BIG,
			],
		];
	}
}
