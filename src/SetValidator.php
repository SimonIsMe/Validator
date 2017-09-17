<?php

namespace Validator;

class SetValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const SET_VALUES_ARE_CORRECT = 0;

	/**
	 * @var int
	 */
	const SET_VALUES_ARE_INCORRECT = 1;

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
	 * @return int -   0 if VALUE is correct
	 *                 > 0 otherwise. Returned value specifies type of error.
	 */
	public function valid($value): int
	{
		foreach ($this->validators as $validator) {
			foreach ($value as $valueItem) {
				$validationResult = $validator->valid($valueItem);
				if ($validationResult > 0) {
					return self::SET_VALUES_ARE_INCORRECT;
				}
			}
		}

		return self::SET_VALUES_ARE_CORRECT;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::SET_VALUES_ARE_CORRECT:
				return 'Ok';
			case self::SET_VALUES_ARE_INCORRECT:
				return 'Values in the set are incorrect.';
		}
	}

	/**
	 * Returns unique name of the validator.
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return 'SetValidator';
	}
}
