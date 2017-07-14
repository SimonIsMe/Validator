<?php

namespace Validator;

class ValidationResult
{
	/**
	 * @var bool
	 */
	private $isValid;

	/**
	 * @param bool $isValid
	 */
	public function __construct(bool $isValid)
	{
		$this->isValid = $isValid;
	}

	/**
	 * @return bool
	 */
	public function isValid() : bool
	{
		return $this->isValid;
	}

}
