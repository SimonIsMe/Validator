<?php

namespace Validator;

interface ValidatorInterface
{
	/**
	 * @param mixed $value
	 *
	 * @return boolean
	 */
	public function isValid($value): boolean;
}
