<?php

namespace Validator;

class IsIntegerValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const IS_INTEGER = 0;

	/**
	 * @var int
	 */
	const IS_NOT_INTEGER = 1;

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
		if (is_int($value)) {
			return 0;
		}

		return 1;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::IS_INTEGER:
				return 'Ok';
			case self::IS_NOT_INTEGER:
				return 'Given value has to be an integer.';
		}

		return '';
	}
}
