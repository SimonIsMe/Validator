<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsEmailValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsEmailValidator();
		$this->assertEquals('IsEmailValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsEmailValidator();
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
				'email@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
				'Ok'
			],
			[
				'email123@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
				'Ok'
			],
			[
				'email.123@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
				'Ok'
			],
			[
				'email-123@domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
				'Ok'
			],
			[
				'email-123+456.def@super.sub.domain.com',
				IsEmailValidator::VALUE_IS_EMAIL,
				'Ok'
			],
			[
				'https://google.com?abc=def&ghi=123',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
			[
				'google.com',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
			[
				'www.google.com',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
			[
				'123',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
			[
				123,
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
			[
				123.456,
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
			[
				true,
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
			[
				'',
				IsEmailValidator::VALUE_IS_NOT_EMAIL,
				'Given email is in incorrect format.'
			],
		];
	}
}
