<?php

namespace Validator;

interface ValidatorInterface
{
	/**
	 * @param mixed $value
	 *
	 * @return int -   0 if VALUE is correct
	 *                 > 0 otherwise. Returned value specifies type of error.
	 */
	public function valid($value): int;

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string;

	/**
	 * Returns unique name of the validator.
	 *
	 * @return string
	 */
	public function getName(): string;
}
