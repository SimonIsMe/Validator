<?php

namespace Validator;

class IsDateValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_IS_DATE = 0;

	/**
	 * @var int
	 */
	const VALUE_IS_NOT_DATE = 1;

	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is correct email address
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (preg_match('/([0-9]{1,})-([0-9]{2})-([0-9]{2})/', $value, $output) == false) {
			return self::VALUE_IS_NOT_DATE;
		}

		if (checkdate($output[2], $output[3], $output[1]) === false) {
			return self::VALUE_IS_NOT_DATE;
		}

		return self::VALUE_IS_DATE;
	}
}