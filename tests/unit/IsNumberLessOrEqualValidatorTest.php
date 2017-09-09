<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNumberLessOrEqualValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsNumberLessOrEqualValidator(12);
		$this->assertEquals('IsNumberLessOrEqualValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($boundary, $value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsNumberLessOrEqualValidator($boundary);
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
				IsNumberLessOrEqualValidator::NUMBER_IS_TOO_BIG,
				'Given value has to be less or equal 20.'
			],
			[
				20,
				20,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20,
				-10,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20.5,
				100,
				IsNumberLessOrEqualValidator::NUMBER_IS_TOO_BIG,
				'Given value has to be less or equal 20.5.'
			],
			[
				20.5,
				20.5,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
			[
				20.5,
				-10,
				IsNumberLessOrEqualValidator::NUMBER_IS_OK,
				'Ok'
			],
		];
	}
}
