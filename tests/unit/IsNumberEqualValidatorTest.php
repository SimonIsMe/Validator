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
	public function test($boundary, $value, $expectedResult)
	{
		$validator = new IsNumberEqualValidator($boundary);
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
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
			],
			[
				20,
				20,
				IsNumberEqualValidator::NUMBER_IS_EQUAL,
			],
			[
				20,
				-10,
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
			],
			[
				20.5,
				100,
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
			],
			[
				20.5,
				20.5,
				IsNumberEqualValidator::NUMBER_IS_EQUAL,
			],
			[
				20.5,
				-10,
				IsNumberEqualValidator::NUMBER_IS_NOT_EQUAL,
			],
		];
	}
}
