<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsTimeValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsTimeValidator();
		$this->assertEquals('IsTimeValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsTimeValidator();
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
				'14:12:15',
				IsTimeValidator::VALUE_IS_TIME,
				'Ok'
			],
			[
				'12:34:34',
				IsTimeValidator::VALUE_IS_TIME,
				'Ok'
			],
			[
				'24:12:15',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'13:72:15',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'13:60:15',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'13:12:60',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'13:12:72',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'23:12:15',
				IsTimeValidator::VALUE_IS_TIME,
				'Ok'
			],
			[
				'00:12:15',
				IsTimeValidator::VALUE_IS_TIME,
				'Ok'
			],
			[
				'04:02:05',
				IsTimeValidator::VALUE_IS_TIME,
				'Ok'
			],
			[
				'4:2:5',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'2016-02-12 14:12:15',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'2016-02-29',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'2017-02-29',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'2017-02-62',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'2017-17-02',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'2017-7-02',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'2017-07-2',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'123',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				123,
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				123.456,
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				true,
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
			[
				'',
				IsTimeValidator::VALUE_IS_NOT_TIME,
				'Given value has not correct time format.'
			],
		];
	}
}
