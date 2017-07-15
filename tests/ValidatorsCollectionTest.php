<?php

namespace Validator;

use PHPUnit\Framework\TestCase;

class ValidatorsCollectionTest extends TestCase
{
	public function test_empty_collection()
	{
		$collection = new ValidatorsCollection([]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertTrue($result->isValid());
	}

	public function test_collection_with_one_validator_when_value_pass()
	{
		$validator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$validator->method('valid')->willReturn(0);

		$collection = new ValidatorsCollection([ $validator ]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertTrue($result->isValid());
	}

	public function test_collection_with_one_validator_when_value_does_not_pass()
	{
		$validator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$validator->method('valid')->willReturn(1);

		$collection = new ValidatorsCollection([ $validator ]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertFalse($result->isValid());
	}

	public function test_validThroughAllValidators_with_few_validator_when_all_validators_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $passedValidator, $passedValidator
		]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertTrue($result->isValid());
	}

	public function test_validThroughAllValidators_with_few_validator_when_one_validator_does_not_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$failedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$failedValidator->method('valid')->willReturn(1);

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $failedValidator, $passedValidator
		]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertFalse($result->isValid());
	}

	public function test_validToFirstError_with_few_validator_when_all_validators_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $passedValidator, $passedValidator
		]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertTrue($result->isValid());
	}

	public function test_validToFirstError_with_few_validator_when_one_validator_does_not_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$failedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid'])
			->getMock();
		$failedValidator->method('valid')->willReturn(1);

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $failedValidator, $passedValidator
		]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertFalse($result->isValid());
	}
}
