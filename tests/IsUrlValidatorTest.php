<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class IsUrlValidatorTest extends TestCase
{
	/**
	 * @dataProvider dataProvider
	 */
	public function test($value, $expectedResult)
	{
		$validator = new IsUrlValidator();
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
				'http://www.google.com',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'http://google.com',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'http://console.developers.google.com',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'https://www.google.com',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'https://google.com',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'https://google.com/path/to/somewhere',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'https://google.com/path/to/somewhere?abc=def&ghi=123',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'https://google.com/?abc=def&ghi=123',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'https://google.com?abc=def&ghi=123',
				IsUrlValidator::VALUE_IS_URL,
			],
			[
				'google.com',
				IsUrlValidator::VALUE_IS_NOT_URL,
			],
			[
				'www.google.com',
				IsUrlValidator::VALUE_IS_NOT_URL,
			],
			[
				'123',
				IsUrlValidator::VALUE_IS_NOT_URL,
			],
			[
				123,
				IsUrlValidator::VALUE_IS_NOT_URL,
			],
			[
				123.456,
				IsUrlValidator::VALUE_IS_NOT_URL,
			],
			[
				true,
				IsUrlValidator::VALUE_IS_NOT_URL,
			],
			[
				'',
				IsUrlValidator::VALUE_IS_NOT_URL,
			],
		];
	}
}
