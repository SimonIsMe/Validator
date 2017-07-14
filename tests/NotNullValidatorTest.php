<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class NotNullValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test_not_null($value, $expectedResult)
	{
		$validator = new NotNullValidator();
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
				null,
				1,
			],
			[
				123,
				0,
			],
			[
				0,
				0,
			],
			[
				123.456,
				0,
			],
			[
				0.0,
				0,
			],
			[
				'abc',
				0,
			],
			[
				'',
				0,
			],
			[
				true,
				0,
			],
			[
				false,
				0,
			],
		];
	}
}
