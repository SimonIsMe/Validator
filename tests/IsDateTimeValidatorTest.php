<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsDateTimeValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsDateTimeValidator();
		$this->assertEquals('IsDateTimeValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult)
	{
		$validator = new IsDateTimeValidator();
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
				'1234-12-13T12:34:34Z',
				IsDateTimeValidator::VALUE_IS_DATE_TIME,
			],
			[
				'2016-02-29T12:34:34Z',
				IsDateTimeValidator::VALUE_IS_DATE_TIME,
			],
			[
				'2015-02-29T12:34:34Z',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'2015-02-29T1:34:34Z',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'2015-02-29T12:34:34',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'2015-02-29t12:34:34z',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34+12:34',
				IsDateTimeValidator::VALUE_IS_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34+13:34',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34+12:64',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34+0:0',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34+00:00',
				IsDateTimeValidator::VALUE_IS_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34-12:34',
				IsDateTimeValidator::VALUE_IS_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34-13:34',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34-12:64',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34-0:0',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'1234-12-13T12:34:34-00:00',
				IsDateTimeValidator::VALUE_IS_DATE_TIME,
			],
			[
				'abc',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				'',
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				123,
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				123.456,
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				true,
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
			[
				null,
				IsDateTimeValidator::VALUE_IS_NOT_DATE_TIME,
			],
		];
	}
}
