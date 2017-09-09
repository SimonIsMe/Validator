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
			case self::VALUE_IS_DATE:
				return 'Ok';
			case self::VALUE_IS_NOT_DATE:
				return 'Given date is not in correct format.';
		}

		return '';
	}

	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is correct date
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
