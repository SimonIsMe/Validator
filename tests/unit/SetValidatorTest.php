<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class SetValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new SetValidator([]);
		$this->assertEquals('SetValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new SetValidator([
			new IsStringValidator(),
			new StringLengthValidator(3),
		]);
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
				[],
				SetValidator::SET_VALUES_ARE_CORRECT,
				'Ok'
			],
			[
				['abcdef'],
				SetValidator::SET_VALUES_ARE_CORRECT,
				'Ok'
			],
			[
				['abcdef', 'ghijkl'],
				SetValidator::SET_VALUES_ARE_CORRECT,
				'Ok'
			],
			[
				['ab', 'ghijkl'],
				SetValidator::SET_VALUES_ARE_INCORRECT,
				'Values in the set are incorrect.'
			],
			[
				['abcdef', 'g'],
				SetValidator::SET_VALUES_ARE_INCORRECT,
				'Values in the set are incorrect.'
			],
		];
	}
}
