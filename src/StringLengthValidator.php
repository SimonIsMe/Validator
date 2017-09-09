<?php

namespace Validator;

class StringLengthValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const HAS_CORRECT_LENGTH = 0;

	/**
	 * @var int
	 */
	const IS_TOO_SHORT = 1;

	/**
	 * @var int
	 */
	const IS_TOO_LONG = 2;

	/**
	 * @var int
	 */
	private $minLength;

	/**
	 * @var int
	 */
	private $maxLength;

	/**
	 * @param int $minLength = 0
	 * @param int $maxLength = -1
	 */
	public function __construct(int $minLength = 0, int $maxLength = -1)
	{
		$this->minLength = $minLength;
		$this->maxLength = $maxLength;
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
	 * @return int -   0 if value is a number
	 *                 1 otherwise
	 */
	public function valid($value): int
	{
		if (strlen($value) < $this->minLength) {
			return self::IS_TOO_SHORT;
		}

		if ($this->maxLength !== -1 && $this->maxLength < strlen($value)) {
			return self::IS_TOO_LONG;
		}

		return self::HAS_CORRECT_LENGTH;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::HAS_CORRECT_LENGTH:
				return 'Ok';
			case self::IS_TOO_SHORT:
			case self::IS_TOO_LONG:
				if ($this->minLength === 0) {
					return 'Given string has to have maximum length equals ' . $this->maxLength . '.';
				}
				if ($this->maxLength === -1) {
					return 'Given string has to have minimum length equals ' . $this->minLength . '.';
				}
				return 'Given string has to have length in given inclusive range <' . $this->minLength . ', ' . $this->maxLength . '>.';
		}

		return '';
	}
}
