<?php

namespace Validator;

class IsTimeValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_IS_TIME = 0;

	/**
	 * @var int
	 */
	const VALUE_IS_NOT_TIME = 1;

	/**
	 * @return string
	 */
	public function getName(): string
	{
		$array = explode('\\', get_class($this));
		return end($array);
	}

	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is correct time
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (preg_match('/([0-9]{2}):([0-9]{2}):([0-9]{2})/', $value, $output) == false) {
			return self::VALUE_IS_NOT_TIME;
		}

		if (23 < ((int) $output[1])) {
			return self::VALUE_IS_NOT_TIME;
		}

		if (59 < ((int) $output[2])) {
			return self::VALUE_IS_NOT_TIME;
		}

		if (59 < ((int) $output[2])) {
			return self::VALUE_IS_NOT_TIME;
		}

		return self::VALUE_IS_TIME;
	}
}
