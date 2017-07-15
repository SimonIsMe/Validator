<?php

namespace Validator;

class ValidationResult
{
	/**
	 * @var bool
	 */
	private $isValid;

	/**
	 * @var int[] - key is validator class name, value is number of error
	 */
	private $errors = [];

	/**
	 * @param bool $isValid
	 * @param int[] $errors
	 */
	public function __construct(bool $isValid, array $errors = [])
	{
		$this->isValid = $isValid;
		$this->errors = $errors;
	}

	/**
	 * @return bool
	 */
	public function isValid() : bool
	{
		return $this->isValid;
	}

	/**
	 * @return int[]
	 */
	public function errors(): array
	{
		return $this->errors;
	}

}
