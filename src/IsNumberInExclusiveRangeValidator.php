<?php

namespace Validator;

class IsNumberInExclusiveRangeValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_FIT_TO_RANGE = 0;

	/**
	 * @var int
	 */
	const VALUE_TOO_SMALL = 1;

	/**
	 * @var int
	 */
	const VALUE_TOO_BIG = 2;

	/**
	 * @var double
	 */
	private $leftBoundary;

	/**
	 * @var double
	 */
	private $rightBoundary;

	/**
	 * @param int | double $leftBoundary
	 * @param int | double $rightBoundary
	 */
	public function __construct($leftBoundary, $rightBoundary)
	{
		$this->leftBoundary = (double) $leftBoundary;
		$this->rightBoundary = (double) $rightBoundary;
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
	 * @return int -   0 if value is in specified range (exclusive)
	 *                 1 if value is too small
	 *                 2 if value is too big
	 */
	public function valid($value): int
	{
		if ($value <= $this->leftBoundary)
		{
			return self::VALUE_TOO_SMALL;
		}

		if ($this->rightBoundary <= $value)
		{
			return self::VALUE_TOO_BIG;
		}

		return self::VALUE_FIT_TO_RANGE;
	}
}
