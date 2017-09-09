<?php

namespace Validator;

class IsEmailValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_IS_EMAIL = 0;

	/**
	 * @var int
	 */
	const VALUE_IS_NOT_EMAIL = 1;

	/**
	 * @return string
	 */
	public function getName(): string
	{
		$array = explode('\\', get_class($this));
		return end($array);
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::VALUE_IS_EMAIL:
				return 'Ok';
			case self::VALUE_IS_NOT_EMAIL:
				return 'Given email is in incorrect format.';
		}

		return '';
	}

	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is correct email address
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
			return self::VALUE_IS_EMAIL;
		}

		return self::VALUE_IS_NOT_EMAIL;
	}
}
