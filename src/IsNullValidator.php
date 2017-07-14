<?php

namespace Validator;

class IsNullValidator implements ValidatorInterface
{
	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is null
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if (is_null($value)) {
			return 0;
		}

		return 1;
	}
}
