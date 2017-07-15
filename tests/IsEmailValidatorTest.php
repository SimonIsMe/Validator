<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsEmailValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test_not_null($value, $expectedResult)
	{
		$validator = new IsEmailValidator();
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
				'email@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
			],
			[
				'email123@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
			],
			[
				'email.123@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
			],
			[
				'email-123@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
			],
			[
				'email-123+456.def@super.sub.domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
			],
			[
				'https://google.com?abc=def&ghi=123',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
			[
				'google.com',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
			[
				'www.google.com',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
			[
				'123',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
			[
				123,
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
			[
				123.456,
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
			[
				true,
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
			[
				'',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
			],
		];
	}
}
