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