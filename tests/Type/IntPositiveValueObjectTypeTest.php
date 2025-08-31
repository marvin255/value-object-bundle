<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Marvin255\ValueObject\IntPositiveValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\IntPositiveValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class IntPositiveValueObjectTypeTest extends BaseCase
{
    public function testGetName(): void
    {
        $type = new IntPositiveValueObjectType();

        $this->assertSame(ValueObjectType::POSITIVE_INTEGER->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = 123;

        $type = new IntPositiveValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new IntPositiveValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = 123;
        $valueObject = new IntPositiveValueObject($value);

        $type = new IntPositiveValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new IntPositiveValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new IntPositiveValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
