<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsNullValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test_not_null($value, $expectedResult)
	{
		$validator = new IsNullValidator();
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
				0,
			],
			[
				123,
				1,
			],
			[
				0,
				1,
			],
			[
				123.456,
				1,
			],
			[
				0.0,
				1,
			],
			[
				'abc',
				1,
			],
			[
				'',
				1,
			],
			[
				true,
				1,
			],
			[
				false,
				1,
			],
		];
	}
}
