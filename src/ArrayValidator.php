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
	 * @param bool $validateThroughAllValidators = true
	 *
	 * @return ValidationResult
	 */
	public function validateArray(array $validators, array $data, bool $validateThroughAllValidators = true): ValidationResult
	{
		$errorCodes = [];
		$errorTexts = [];

		foreach ($validators as $key => $validator) {
			if (array_key_exists($key, $data) === false) {
				$errorCodes[$key] = self::NOT_EXISTS;
				$errorTexts[$key] = 'This value does not exist.';
				continue;
			}

			if (is_array($validator)) {
				$result = $this->validateArray($validator, $data[$key]);
				if ($result->isValid() === false) {
					$errorCodes[$key] = $result->errorCodes();
					$errorTexts[$key] = $result->errorsTexts();
				}
				continue;
			}


			if ($validator instanceof ValidatorsCollection) {
				if ($validateThroughAllValidators) {
					$result = $validator->validThroughAllValidators($data[$key]);
				} else {
					$result = $validator->validToFirstError($data[$key]);
				}

				if ($result->isValid() === false) {
					$errorCodes[$key] = $result->errorCodes();
					$errorTexts[$key] = $result->errorsTexts();
				}
				continue;
			}

			if (is_array($data[$key])) {
				$errorCodes[$key] = self::IS_ARRAY;
				$errorTexts[$key] = 'This value has to be a single value.';
				continue;
			}

			$validationResult = $validator->valid($data[$key]);
			if ($validationResult > 0) {
				$errorCodes[$key] = $validationResult;
				$errorTexts[$key] = $validator->errorText($validationResult);
			}
		}

		return new ValidationResult(empty($errorCodes), $errorCodes, $errorTexts);
	}
}
