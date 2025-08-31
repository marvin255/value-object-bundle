<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Marvin255\ValueObject\IntNonNegativeValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\IntNonNegativeValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class IntNonNegativeValueObjectTypeTest extends BaseCase
{
    public function testGetName(): void
    {
        $type = new IntNonNegativeValueObjectType();

        $this->assertSame(ValueObjectType::NON_NEGATIVE_INTEGER->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = 0;

        $type = new IntNonNegativeValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new IntNonNegativeValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = 0;
        $valueObject = new IntNonNegativeValueObject($value);

        $type = new IntNonNegativeValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new IntNonNegativeValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new IntNonNegativeValueObjectType();
        $type->convertToDatabaseValue(-1, $this->createAbstarctPlatformMock());
    }
}
