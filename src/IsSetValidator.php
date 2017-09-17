<?php

namespace Validator;

class IsSetValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const IS_SET = 0;

	/**
	 * @var int
	 */
	const IS_NOT_SET = 1;

	/**
	 * @param mixed $value
	 *
	 * @return int -   0 if VALUE is correct
	 *                 > 0 otherwise. Returned value specifies type of error.
	 */
	public function valid($value): int
	{
		if (is_array($value)) {
			return self::IS_SET;
		}

		return self::IS_NOT_SET;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::IS_SET:
				return 'Ok';
			case self::IS_NOT_SET:
				return 'Given value is not a set.';
		}
	}

	/**
	 * Returns unique name of the validator.
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return 'IsSetValidator';
	}
}
