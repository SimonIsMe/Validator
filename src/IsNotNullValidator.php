<?php

namespace Validator;

class IsNotNullValidator implements ValidatorInterface
{
	/**
	 * @param mixed $value
	 *
	 * @return int
	 */
	public function valid($value): int
	{
		if (is_null($value)) {
			return 1;
		}

		return 0;
	}
}
