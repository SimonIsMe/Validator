<?php

namespace Tests\helpers;

use Validator\ValidatorInterface;

class StubValidator implements ValidatorInterface
{

	/**
	 * @var int
	 */
	private $valid;

	/**
	 * @var string
	 */
	private $name;

	/**
	 * @param int $valid
	 * @param string $name
	 */
	public function __construct(int $valid, string $name)
	{
		$this->valid = $valid;
		$this->name = $name;
	}

	/**
	 * @param mixed $value
	 *
	 * @return int -   0 if VALUE is correct
	 *                 > 0 otherwise. Returned value specifies type of error.
	 */
	public function valid($value): int
	{
		return $this->valid;
	}

	/**
	 * Returns unique name of the validator.
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		return $validationResult . '';
	}
}
