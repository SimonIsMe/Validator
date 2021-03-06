<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberGreaterOrEqualValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberGreaterOrEqualValidator(12);
		$this->assertEquals('IsNumberGreaterOrEqualValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNumberGreaterOrEqualValidator($boundary);
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
				IsNumberGreaterOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20,
				20,
				IsNumberGreaterOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20,
				-10,
				IsNumberGreaterOrEqualValidator::NUMBER_IS_TOO_SMALL,
				'Given number has to be greater or equal 20.'
			],
			[
				20.5,
				100,
				IsNumberGreaterOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20.5,
				20.5,
				IsNumberGreaterOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20.5,
				-10,
				IsNumberGreaterOrEqualValidator::NUMBER_IS_TOO_SMALL,
				'Given number has to be greater or equal 20.5.'
			],
		];
	}
}
