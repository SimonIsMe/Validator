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
	private $errorCodes = [];

	/**
	 * @var array
	 */
	private $errorTexts = [];

	/**
	 * @param bool $isValid
	 * @param array $errorCodes
	 * @param array $errorTexts
	 */
	public function __construct(bool $isValid, array $errorCodes = [], array $errorTexts = [])
	{
		$this->isValid = $isValid;
		$this->errorCodes = $errorCodes;
		$this->errorTexts = $errorTexts;
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
	public function errorCodes(): array
	{
		return $this->errorCodes;
	}

	/**
	 * @return array
	 */
	public function errorsTexts(): array
	{
		return $this->errorTexts;
	}
}
