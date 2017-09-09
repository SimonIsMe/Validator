<?php

namespace Validator;

class IsValueFromSetValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const IS_IN_SET = 0;

	/**
	 * @var int
	 */
	const IS_NOT_IN_SET = 1;

	/**
	 * @var array
	 */
	private $set = [];

	/**
	 * @param array $set
	 */
	public function __construct(array $set)
	{
		$this->set = $set;
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
	 * @return int
	 */
	public function valid($value): int
	{
		foreach ($this->set as $item) {
			if($item === $value) {
				return self::IS_IN_SET;
			}
		}

		return self::IS_NOT_IN_SET;
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::IS_IN_SET:
				return 'Ok';
			case self::IS_NOT_IN_SET:
				return 'Given value is incorrect. We accept only those values: ' . implode(',', $this->set) . '.';
		}

		return '';
	}
}
