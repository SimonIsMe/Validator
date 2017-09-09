<?php

namespace Validator;

/**
 * This class checks if given value is date-time value in one of those format:
 * - YYYY-MM-DDTHH:II:SSZ
 * - YYYY-MM-DDTHH:II:SS+AA:BB
 * - YYYY-MM-DDTHH:II:SS-AA:BB
 *
 * Where
 *  - YYYY - year
 *  - MM - number of month(1-12)
 *  - DD - number of day (1-28/29/30/31)
 *  - HH - number of hour (0-23)
 *  - II - number of minute (0-59)
 *  - SS - number of second (0-59)
 *  - AA - number of offset hours (0-12)
 *  - BB - number of offset minutes (0-59)
 *
 * 'T' and 'Z' are required letters.
 */
class IsDateTimeValidator implements ValidatorInterface
{
	/**
	 * @var int
	 */
	const VALUE_IS_DATE_TIME = 0;

	/**
	 * @var int
	 */
	const VALUE_IS_NOT_DATE_TIME = 1;

	/**
	 * @var IsDateValidator
	 */
	private $isDateValidator;

	/**
	 * @var IsTimeValidator
	 */
	private $isTimeValidator;

	public function __construct()
	{
		$this->isDateValidator = new IsDateValidator();
		$this->isTimeValidator = new IsTimeValidator();
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
	 * @return int  - returns 0 if value is correct date and time
	 *                        1 otherwise
	 */
	public function valid($value): int
	{
		if ($this->validTimeWithoutTimeOffset($value) === self::VALUE_IS_DATE_TIME) {
			return self::VALUE_IS_DATE_TIME;
		}

		return $this->validTimeWithTimeOffset($value);
	}

	/**
	 * @param int $validationResult
	 *
	 * @return string
	 */
	public function errorText(int $validationResult): string
	{
		switch ($validationResult) {
			case self::VALUE_IS_DATE_TIME:
				return 'Ok';
			case self::VALUE_IS_NOT_DATE_TIME:
				return 'Given date is not in correct format.';
		}

		return '';
	}

	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is correct date-time value
	 *                          without time offset
	 *                        1 otherwise
	 */
	private function validTimeWithoutTimeOffset($value): int
	{
		if (preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})T([0-9]{2}):([0-9]{2}):([0-9]{2})Z$/", $value, $output) == false) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}

		$dateString = $output[1] . '-' . $output[2] . '-' . $output[3];
		if ($this->isDateValidator->valid($dateString) === IsDateValidator::VALUE_IS_NOT_DATE) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}


		$timeString = $output[4] . ':' . $output[5] . ':' . $output[6];
		if ($this->isTimeValidator->valid($timeString) === IsTimeValidator::VALUE_IS_NOT_TIME) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}

		return self::VALUE_IS_DATE_TIME;
	}

	/**
	 * @param mixed $value
	 *
	 * @return int  - returns 0 if value is correct date-time value
	 *                          with time offset
	 *                        1 otherwise
	 */
	private function validTimeWithTimeOffset($value): int
	{
		if (preg_match('/^([0-9]{4})-([0-9]{2})-([0-9]{2})T([0-9]{2}):([0-9]{2}):([0-9]{2})[+-]([0-9]{2}):([0-9]{2})$/', $value, $output) == false) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}

		$dateString = $output[1] . '-' . $output[2] . '-' . $output[3];
		if ($this->isDateValidator->valid($dateString) === IsDateValidator::VALUE_IS_NOT_DATE) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}

		$timeString = $output[4] . ':' . $output[5] . ':' . $output[6];
		if ($this->isTimeValidator->valid($timeString) === IsTimeValidator::VALUE_IS_NOT_TIME) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}

		if (12 < ((int) $output[7])) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}

		if (59 < ((int) $output[8])) {
			return self::VALUE_IS_NOT_DATE_TIME;
		}

		return self::VALUE_IS_DATE_TIME;
	}
}
