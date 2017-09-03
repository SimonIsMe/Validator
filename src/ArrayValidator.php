<?php

namespace Validator;

class ArrayValidator
{
	/**
	 * @var string
	 */
	const NOT_EXISTS = 'NOT EXISTS';

	/**
	 * @var string
	 */
	const IS_ARRAY = 'IS ARRAY';

	/**
	 * @param array $validators
	 * @param array $data
	 *
	 * @return ValidationResult
	 */
	public function validateArray(array $validators, array $data): ValidationResult
	{
		$errors = [];

		foreach ($validators as $key => $validator) {
			if (array_key_exists($key, $data) === false) {
				$errors[$key] = self::NOT_EXISTS;
				continue;
			}

			if (is_array($validator)) {
				$result = $this->validateArray($validator, $data[$key]);
				if ($result->isValid() === false) {
					$errors[$key] = $result->errors();
				}
				continue;
			}

			if (is_array($data[$key])) {
				$errors[$key] = self::IS_ARRAY;
				continue;
			}

			if ($validator instanceof ValidatorsCollection) {
				$result = $validator->validThroughAllValidators($data[$key]);
				if ($result->isValid() === false) {
					$errors[$key] = $result->errors();
				}
				continue;
			}

			$validationResult = $validator->valid($data[$key]);
			if ($validationResult > 0) {
				$errors[$key] = $validationResult;
			}
		}

		return new ValidationResult(empty($errors), $errors);
	}
}
