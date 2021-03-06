<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberInInclusiveRangeValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberInInclusiveRangeValidator(12, 45);
		$this->assertEquals('IsNumberInInclusiveRangeValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundaryLeft, $boundaryRight, $value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNumberInInclusiveRangeValidator($boundaryLeft, $boundaryRight);
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
				-20,
				50,
				-100,
				IsNumberInInclusiveRangeValidator::VALUE_TOO_SMALL,
				'Given value has to be in inclusive range <-20, 50>.'
			],
			[
				-20,
				50,
				-20,
				IsNumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20,
				50,
				0,
				IsNumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20,
				50,
				50,
				IsNumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20,
				50,
				100,
				IsNumberInInclusiveRangeValidator::VALUE_TOO_BIG,
				'Given value has to be in inclusive range <-20, 50>.'
			],
			[
				-20.0,
				50.0,
				-100,
				IsNumberInInclusiveRangeValidator::VALUE_TOO_SMALL,
				'Given value has to be in inclusive range <-20, 50>.'
			],
			[
				-20.0,
				50.0,
				-20,
				IsNumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20.0,
				50.0,
				0,
				IsNumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20.0,
				50.0,
				50,
				IsNumberInInclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20.0,
				50.0,
				100,
				IsNumberInInclusiveRangeValidator::VALUE_TOO_BIG,
				'Given value has to be in inclusive range <-20, 50>.'
			],
		];
	}
}
