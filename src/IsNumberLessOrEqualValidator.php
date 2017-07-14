<?php

namespace Validator;

class IsNumberLessOrEqualValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const NUMBER_IS_OK = 0;

	/**
	 * @var int
	 */
	const NUMBER_IS_TOO_BIG = 1;

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
			return self::NUMBER_IS_OK;
		}

		return self::NUMBER_IS_TOO_BIG;
	}
}
