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
	public function validThroughAllValidators($value) : ValidationResult
	{
		$isValid = true;
		foreach ($this->validators as $validator) {
			$isValid &= $validator->valid($value) === 0;
		}

		return new ValidationResult($isValid);
	}

	/**
	 * @param mixed $value
	 *
	 * @return ValidationResult
	 */
	public function validToFirstError($value) : ValidationResult
	{
		foreach ($this->validators as $validator) {
			if ($validator->valid($value)) {
				return new ValidationResult(false);
			}
		}

		return new ValidationResult(true);
	}
}
