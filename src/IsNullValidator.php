<?php

namespace Validator;

class IsNullValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_IS_NULL = 0;

	/**
	 * @var int
	 */
	const VALUE_IS_NOT_NULL = 1;

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
	 * @return int  - returns 0 if value is null
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (is_null($value)) {
			return self::VALUE_IS_NULL;
		}

		return self::VALUE_IS_NOT_NULL;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::VALUE_IS_NULL:
				return 'Ok';
			case self::VALUE_IS_NOT_NULL:
				return 'Given value has to be null.';
		}

		return '';
	}
}
