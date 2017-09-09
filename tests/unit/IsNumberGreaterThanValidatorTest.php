<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberGreaterThanValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberGreaterThanValidator(12);
		$this->assertEquals('IsNumberGreaterThanValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNumberGreaterThanValidator($boundary);
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
				IsNumberGreaterThanValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20,
				20,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
				'Given number has to be greater than 20.'
			],
			[
				20,
				-10,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
				'Given number has to be greater than 20.'
			],
			[
				20.5,
				100,
				IsNumberGreaterThanValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20.5,
				20.5,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
				'Given number has to be greater than 20.5.'
			],
			[
				20.5,
				-10,
				IsNumberGreaterThanValidator::NUMBER_IS_TOO_SMALL,
				'Given number has to be greater than 20.5.'
			],
		];
	}
}
