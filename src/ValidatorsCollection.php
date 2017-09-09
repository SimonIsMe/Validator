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
		$errorCodes = [];
		$errorTexts = [];

		foreach ($this->validators as $validator) {
			$validationResult = $validator->valid($value);
			if ($validationResult > 0) {
				$errorCodes[$validator->getName()] = $validationResult;
				$errorTexts[$validator->getName()] = $validator->errorText($validationResult);
			}
			$isValid &= $validationResult === 0;
		}

		return new ValidationResult($isValid, $errorCodes, $errorTexts);
	}

	/**
	 * @param mixed $value
	 *
	 * @return ValidationResult
	 */
	public function validToFirstError($value) : ValidationResult
	{
		foreach ($this->validators as $validator) {
			$validationResult = $validator->valid($value);
			if ($validationResult > 0) {
				return new ValidationResult(
					false,
					[ $validator->getName() => $validationResult ],
					[ $validator->getName() => $validator->errorText($validationResult) ]
				);
			}
		}

		return new ValidationResult(true);
	}
}
