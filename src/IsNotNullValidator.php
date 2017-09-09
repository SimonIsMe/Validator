<?php

namespace Validator;

class IsNotNullValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_IS_NOT_NULL = 0;

	/**
	 * @var int
	 */
	const VALUE_IS_NULL = 1;

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
			case self::VALUE_IS_NOT_NULL:
				return 'Ok';
			case self::VALUE_IS_NULL:
				return 'Given value can not be null.';
		}

		return '';
	}

	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is NOT null
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (is_null($value)) {
			return self::VALUE_IS_NULL;
		}

		return self::VALUE_IS_NOT_NULL;
	}
}
