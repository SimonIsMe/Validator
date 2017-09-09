<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsValueFromSetValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsValueFromSetValidator([]);
		$this->assertEquals('IsValueFromSetValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsValueFromSetValidator([false, 1, 2.0, 'a']);
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
				true,
				IsValueFromSetValidator::IS_NOT_IN_SET,
				'Given value is incorrect. We accept only those values: ,1,2,a.'
			],
			[
				false,
				IsValueFromSetValidator::IS_IN_SET,
				'Ok'
			],
			[
				1,
				IsValueFromSetValidator::IS_IN_SET,
				'Ok'
			],
			[
				'1',
				IsValueFromSetValidator::IS_NOT_IN_SET,
				'Given value is incorrect. We accept only those values: ,1,2,a.'
			],
			[
				2.0,
				IsValueFromSetValidator::IS_IN_SET,
				'Ok'
			],
			[
				'2.0',
				IsValueFromSetValidator::IS_NOT_IN_SET,
				'Given value is incorrect. We accept only those values: ,1,2,a.'
			],
			[
				-123,
				IsValueFromSetValidator::IS_NOT_IN_SET,
				'Given value is incorrect. We accept only those values: ,1,2,a.'
			],
			[
				'a',
				IsValueFromSetValidator::IS_IN_SET,
				'Ok'
			],
			[
				'abc',
				IsValueFromSetValidator::IS_NOT_IN_SET,
				'Given value is incorrect. We accept only those values: ,1,2,a.'
			],
		];
	}
}
