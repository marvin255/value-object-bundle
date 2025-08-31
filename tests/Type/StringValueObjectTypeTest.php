<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Marvin255\ValueObject\StringValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\StringValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class StringValueObjectTypeTest extends BaseCase
{
    public function testGetName(): void
    {
        $type = new StringValueObjectType();

        $this->assertSame(ValueObjectType::STRING->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = 'test string';

        $type = new StringValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new StringValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = 'test string';
        $valueObject = new StringValueObject($value);

        $type = new StringValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new StringValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new StringValueObjectType();
        $type->convertToDatabaseValue(123, $this->createAbstarctPlatformMock());
    }
}
