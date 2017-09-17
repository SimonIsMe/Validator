<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsSetValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsSetValidator();
		$this->assertEquals('IsSetValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsSetValidator();
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
				IsSetValidator::IS_SET,
				'Ok'
			],
			[
				['aaa', 123, ['aa']],
				IsSetValidator::IS_SET,
				'Ok'
			],
			[
				123,
				IsSetValidator::IS_NOT_SET,
				'Given value is not a set.'
			],
			[
				-123.45,
				IsSetValidator::IS_NOT_SET,
				'Given value is not a set.'
			],
			[
				'aaa',
				IsSetValidator::IS_NOT_SET,
				'Given value is not a set.'
			],
			[
				true,
				IsSetValidator::IS_NOT_SET,
				'Given value is not a set.'
			],
			[
				null,
				IsSetValidator::IS_NOT_SET,
				'Given value is not a set.'
			],
		];
	}
}
