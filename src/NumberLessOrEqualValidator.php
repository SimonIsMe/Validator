<?php

namespace Validator;

class NumberLessOrEqualValidator implements ValidatorInterface
{
	/**
	 * @var double
	 */
	private $boundary;

	/**
	 * @param int | double $boundary
	 */
	public function __construct($boundary)
	{
		$this->boundary = (double) $boundary;
	}


	/**
	 * @param mixed $value
	 *
	 * @return int -   0 if VALUE is less or equal specified value
	 *                 1 otherwise
	 */
	public function valid($value): int
	{
		if ($this->boundary >= $value) {
			return 0;
		}

		return 1;
	}
}
