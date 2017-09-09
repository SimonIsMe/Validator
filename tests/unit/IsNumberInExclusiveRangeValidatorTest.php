<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberInExclusiveRangeValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberInExclusiveRangeValidator(12, 45);
		$this->assertEquals('IsNumberInExclusiveRangeValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundaryLeft, $boundaryRight, $value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNumberInExclusiveRangeValidator($boundaryLeft, $boundaryRight);
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
				IsNumberInExclusiveRangeValidator::VALUE_TOO_SMALL,
				'Given value has to be in exclusive range (-20, 50).'
			],
			[
				-20,
				50,
				-20,
				IsNumberInExclusiveRangeValidator::VALUE_TOO_SMALL,
				'Given value has to be in exclusive range (-20, 50).'
			],
			[
				-20,
				50,
				0,
				IsNumberInExclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20,
				50,
				50,
				IsNumberInExclusiveRangeValidator::VALUE_TOO_BIG,
				'Given value has to be in exclusive range (-20, 50).'
			],
			[
				-20,
				50,
				100,
				IsNumberInExclusiveRangeValidator::VALUE_TOO_BIG,
				'Given value has to be in exclusive range (-20, 50).'
			],
			[
				-20.0,
				50.0,
				-100,
				IsNumberInExclusiveRangeValidator::VALUE_TOO_SMALL,
				'Given value has to be in exclusive range (-20, 50).'
			],
			[
				-20.0,
				50.0,
				-20,
				IsNumberInExclusiveRangeValidator::VALUE_TOO_SMALL,
				'Given value has to be in exclusive range (-20, 50).'
			],
			[
				-20.0,
				50.0,
				0,
				IsNumberInExclusiveRangeValidator::VALUE_FIT_TO_RANGE,
				'Ok'
			],
			[
				-20.0,
				50.0,
				50,
				IsNumberInExclusiveRangeValidator::VALUE_TOO_BIG,
				'Given value has to be in exclusive range (-20, 50).'
			],
			[
				-20.0,
				50.0,
				100,
				IsNumberInExclusiveRangeValidator::VALUE_TOO_BIG,
				'Given value has to be in exclusive range (-20, 50).'
			],
		];
	}
}
