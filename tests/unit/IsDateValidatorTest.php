<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsDateValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsDateValidator();
		$this->assertEquals('IsDateValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult)
	{
		$validator = new IsDateValidator();
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
				'17-07-02',
				IsDateValidator::VALUE_IS_DATE,
			],
			[
				'2012-12-12',
				IsDateValidator::VALUE_IS_DATE,
			],
			[
				'2012-02-28',
				IsDateValidator::VALUE_IS_DATE,
			],
			[
				'2016-02-29',
				IsDateValidator::VALUE_IS_DATE,
			],
			[
				'2017-02-29',
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				'2017-02-62',
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				'2017-17-02',
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				'2017-7-02',
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				'2017-07-2',
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				'123',
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				123,
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				123.456,
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				true,
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
			[
				'',
				IsDateValidator::VALUE_IS_NOT_DATE,
			],
		];
	}
}
