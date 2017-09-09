<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberEqualValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberEqualValidator(12);
		$this->assertEquals('IsNumberEqualValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNumberEqualValidator($boundary);
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
				20,
				100,
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
				'Given number is not equal to 20.'
			],
			[
				20,
				20,
				IsNumberEqualValidator::NUMBER_IS_EQUAL,
				'Ok'
			],
			[
				20,
				-10,
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
				'Given number is not equal to 20.'
			],
			[
				20.5,
				100,
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
				'Given number is not equal to 20.5.'

			],
			[
				20.5,
				20.5,
				IsNumberEqualValidator::NUMBER_IS_EQUAL,
				'Ok'
			],
			[
				20.5,
				-10,
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
				'Given number is not equal to 20.5.'
			],
		];
	}
}
