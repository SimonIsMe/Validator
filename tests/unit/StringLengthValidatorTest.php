<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class StringLengthValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new StringLengthValidator();
		$this->assertEquals('StringLengthValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $minLength, $maxLength, $expectedResult, $expectedErrorMessage)
	{
		$validator = new StringLengthValidator($minLength, $maxLength);
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
				'',
				0,
				-1,
				StringLengthValidator::HAS_CORRECT_LENGTH,
				'Ok'
			],
			[
				'Lorem ipsum dolorem',
				10,
				-1,
				StringLengthValidator::HAS_CORRECT_LENGTH,
				'Ok'
			],
			[
				'Lorem ipsum dolorem',
				19,
				-1,
				StringLengthValidator::HAS_CORRECT_LENGTH,
				'Ok'
			],
			[
				'Lorem ipsum dolorem',
				20,
				-1,
				StringLengthValidator::IS_TOO_SHORT,
				'Given string has to have minimum length equals 20.'
			],
			[
				'Lorem ipsum dolorem',
				0,
				19,
				StringLengthValidator::HAS_CORRECT_LENGTH,
				'Ok'
			],
			[
				'Lorem ipsum dolorem',
				0,
				18,
				StringLengthValidator::IS_TOO_LONG,
				'Given string has to have maximum length equals 18.'
			],
			[
				'Lorem ipsum dolorem',
				1,
				18,
				StringLengthValidator::IS_TOO_LONG,
				'Given string has to have length in given inclusive range <1, 18>.'
			],
		];
	}
}
