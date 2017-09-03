<?php

namespace Validator;

class ValidationResult
{
	/**
	 * @var bool
	 */
	private $isValid;

	/**
	 * @var array
	 */
	private $errors = [];

	/**
	 * @param bool $isValid
	 * @param array $errors
	 */
	public function __construct(bool $isValid, array $errors = [])
	{
		$this->isValid = $isValid;
		$this->errors = $errors;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return end(explode('\\', get_class($this)));
	}

	/**
	 * @return bool
	 */
	public function isValid() : bool
	{
		return $this->isValid;
	}

	/**
	 * @return array
	 */
	public function errors(): array
	{
		return $this->errors;
	}

}
