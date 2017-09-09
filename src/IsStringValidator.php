<?php

namespace Validator;

class IsStringValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const IS_STRING = 0;

	/**
	 * @var int
	 */
	const IS_NOT_STRING = 1;

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
		if (is_string($value)) {
			return self::IS_STRING;
		}

		return self::IS_NOT_STRING;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::IS_STRING:
				return 'Ok';
			case self::IS_NOT_STRING:
				return 'Given value has to be a string.';
		}

		return '';
	}
}
