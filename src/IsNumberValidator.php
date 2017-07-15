<?php

namespace Validator;

class IsNumberValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const IS_NUMBER = 0;

	/**
	 * @var int
	 */
	const IS_NOT_NUMBER = 1;

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
	 * @return int -   0 if value is a number
	 *                 1 otherwise
	 */
	public function valid($value): int
	{
		if (is_numeric($value)) {
			return 0;
		}

		return 1;
	}
}
