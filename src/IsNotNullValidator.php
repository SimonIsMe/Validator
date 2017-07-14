<?php

namespace Validator;

class IsNotNullValidator implements ValidatorInterface
{
	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is NOT null
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (is_null($value)) {
			return 1;
		}

		return 0;
	}
}
