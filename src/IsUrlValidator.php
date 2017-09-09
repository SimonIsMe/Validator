<?php

namespace Validator;

class IsUrlValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_IS_URL = 0;

	/**
	 * @var int
	 */
	const VALUE_IS_NOT_URL = 1;

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
	 * @return int  - returns 0 if value is correct URL
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (filter_var($value, FILTER_VALIDATE_URL)) {
			return self::VALUE_IS_URL;
		}

		return self::VALUE_IS_NOT_URL;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::VALUE_IS_URL:
				return 'Ok';
			case self::VALUE_IS_NOT_URL:
				return 'Given value has not correct URL format.';
		}

		return '';
	}
}
