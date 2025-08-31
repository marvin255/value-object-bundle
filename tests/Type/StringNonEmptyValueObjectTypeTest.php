<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Marvin255\ValueObject\StringNonEmptyValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\StringNonEmptyValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class StringNonEmptyValueObjectTypeTest extends BaseCase
{
    public function testGetName(): void
    {
        $type = new StringNonEmptyValueObjectType();

        $this->assertSame(ValueObjectType::NON_EMPTY_STRING->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = 'test string';

        $type = new StringNonEmptyValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new StringNonEmptyValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = 'test string';
        $valueObject = new StringNonEmptyValueObject($value);

        $type = new StringNonEmptyValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new StringNonEmptyValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new StringNonEmptyValueObjectType();
        $type->convertToDatabaseValue('', $this->createAbstarctPlatformMock());
    }
}
