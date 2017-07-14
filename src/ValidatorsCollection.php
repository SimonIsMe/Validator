<?php

namespace Validator;

class ValidatorsCollection
{
	/**
	 * @var ValidatorInterface[]
	 */
	private $validators = [];

	/**
	 * @param ValidatorInterface[] $validators
	 */
	public function __construct(array $validators)
	{
		$this->validators = $validators;
	}

	/**
	 * @param mixed $value
	 *
	 * @return ValidationResult
	 */
	public function valid($value) : ValidationResult
	{
		$isValid = true;
		foreach ($this->validators as $validator) {
			$isValid &= $validator->valid($value) === 0;
		}

		return new ValidationResult($isValid);
	}
}
