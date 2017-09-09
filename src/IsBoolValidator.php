<?php

namespace Validator;

class IsBoolValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const IS_BOOL = 0;

	/**
	 * @var int
	 */
	const IS_NOT_BOOL = 1;

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
		if (is_bool($value)) {
			return self::IS_BOOL;
		}

		return self::IS_NOT_BOOL;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::IS_BOOL:
				return 'Ok';
			case self::IS_NOT_BOOL:
				return 'Given value has to be a bool value.';
		}

		return '';
	}
}
