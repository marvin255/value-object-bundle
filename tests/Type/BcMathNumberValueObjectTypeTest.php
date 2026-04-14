<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Doctrine\DBAL\ParameterType;
use Marvin255\ValueObject\BcMathNumberValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\BcMathNumberValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class BcMathNumberValueObjectTypeTest extends BaseCase
{
    #[\Override]
    protected function setUp(): void
    {
        parent::setUp();
        if (!class_exists('BcMath\Number')) {
            $this->markTestSkipped('BcMath library is not installed');
        }
    }

    public function testGetBindingType(): void
    {
        $type = new BcMathNumberValueObjectType();

        $this->assertSame(ParameterType::STRING, $type->getBindingType());
    }

    public function testGetName(): void
    {
        $type = new BcMathNumberValueObjectType();

        $this->assertSame(ValueObjectType::BC_MATH_NUMBER->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = '123.456789';

        $type = new BcMathNumberValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, (string) $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new BcMathNumberValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = '123.456789';
        $valueObject = new BcMathNumberValueObject($value);

        $type = new BcMathNumberValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueWithNumber(): void
    {
        $value = new \BcMath\Number('123.456789');
        $valueObject = new BcMathNumberValueObject($value);

        $type = new BcMathNumberValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame('123.456789', $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new BcMathNumberValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new BcMathNumberValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
