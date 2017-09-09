<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsUrlValidatorTest extends TestCase
{
	public function test_getName()
	{
		$validator = new IsUrlValidator();
		$this->assertEquals('IsUrlValidator', $validator->getName());
	}

	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult, $expectedErrorMessage)
	{
		$validator = new IsUrlValidator();
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
				'http://www.google.com',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'http://google.com',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'http://console.developers.google.com',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'https://www.google.com',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'https://google.com',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'https://google.com/path/to/somewhere',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'https://google.com/path/to/somewhere?abc=def&ghi=123',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'https://google.com/?abc=def&ghi=123',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'https://google.com?abc=def&ghi=123',
				IsUrlValidator::VALUE_IS_URL,
				'Ok'
			],
			[
				'google.com',
				IsUrlValidator::VALUE_IS_NOT_URL,
				'Given value has not correct URL format.'
			],
			[
				'www.google.com',
				IsUrlValidator::VALUE_IS_NOT_URL,
				'Given value has not correct URL format.'
			],
			[
				'123',
				IsUrlValidator::VALUE_IS_NOT_URL,
				'Given value has not correct URL format.'
			],
			[
				123,
				IsUrlValidator::VALUE_IS_NOT_URL,
				'Given value has not correct URL format.'
			],
			[
				123.456,
				IsUrlValidator::VALUE_IS_NOT_URL,
				'Given value has not correct URL format.'
			],
			[
				true,
				IsUrlValidator::VALUE_IS_NOT_URL,
				'Given value has not correct URL format.'
			],
			[
				'',
				IsUrlValidator::VALUE_IS_NOT_URL,
				'Given value has not correct URL format.'
			],
		];
	}
}
