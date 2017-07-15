<?php

namespace Validator;

class IsNumberGreaterOrEqualValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const NUMBER_IS_OK = 0;

	/**
	 * @var int
	 */
	const NUMBER_IS_TOO_SMALL = 1;

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
	 * @return int -   0 if VALUE is greater or equal specified value
	 *                 1 otherwise
	 */
	public function valid($value): int
	{
		if ($this->boundary <= $value) {
			return self::NUMBER_IS_OK;
		}

		return self::NUMBER_IS_TOO_SMALL;
	}
}
