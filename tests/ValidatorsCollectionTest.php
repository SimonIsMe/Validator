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
		$this->assertEmpty($result->errors());
	}

	public function test_collection_with_one_validator_when_value_pass()
	{
		$validator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$validator->method('valid')->willReturn(0);

		$collection = new ValidatorsCollection([ $validator ]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertTrue($result->isValid());
		$this->assertEmpty($result->errors());
	}

	public function test_collection_with_one_validator_when_value_does_not_pass()
	{
		$validator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$validator->method('valid')->willReturn(1);
		$validator->method('getName')->willReturn('abc');

		$collection = new ValidatorsCollection([ $validator ]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertFalse($result->isValid());
		$this->assertEquals(['abc' => 1], $result->errors());
	}

	public function test_validThroughAllValidators_with_few_validator_when_all_validators_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $passedValidator, $passedValidator
		]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertTrue($result->isValid());
		$this->assertEmpty($result->errors());
	}

	public function test_validThroughAllValidators_with_few_validator_when_one_validator_does_not_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$failedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$failedValidator->method('valid')->willReturn(1);
		$failedValidator->method('getName')->willReturn('xyz');

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $failedValidator, $passedValidator
		]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertFalse($result->isValid());
		$this->assertEquals([ 'xyz' => 1 ], $result->errors());
	}

	public function test_validThroughAllValidators_with_few_validator_when_twoe_validators_do_not_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$failedFirstValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$failedFirstValidator->method('valid')->willReturn(1);
		$failedFirstValidator->method('getName')->willReturn('abc');

		$failedSecondValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$failedSecondValidator->method('valid')->willReturn(2);
		$failedSecondValidator->method('getName')->willReturn('xyz');

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $failedFirstValidator, $failedSecondValidator, $passedValidator
		]);
		$result = $collection->validThroughAllValidators('abcdef');

		$this->assertFalse($result->isValid());
		$this->assertEquals([ 'abc' => 1, 'xyz' => 2 ], $result->errors());
	}

	public function test_validToFirstError_with_few_validator_when_all_validators_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $passedValidator, $passedValidator
		]);
		$result = $collection->validToFirstError('abcdef');

		$this->assertTrue($result->isValid());
		$this->assertEmpty($result->errors());
	}

	public function test_validToFirstError_with_few_validator_when_two_validators_do_not_pass_value()
	{
		$passedValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$passedValidator->method('valid')->willReturn(0);

		$failedFirstValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$failedFirstValidator->method('valid')->willReturn(1);
		$failedFirstValidator->method('getName')->willReturn('abc');

		$failedSecondValidator = $this->getMockBuilder(ValidatorInterface::class)
			->setMethods(['valid', 'getName'])
			->getMock();
		$failedSecondValidator->method('valid')->willReturn(2);
		$failedSecondValidator->method('getName')->willReturn('xyz');

		$collection = new ValidatorsCollection([
			$passedValidator, $passedValidator, $failedFirstValidator, $failedSecondValidator, $passedValidator
		]);
		$result = $collection->validToFirstError('abcdef');

		$this->assertFalse($result->isValid());
		$this->assertEquals([ 'abc' => 1 ], $result->errors());
	}
}
