<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Marvin255\ValueObject\EmailValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\EmailValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class EmailValueObjectTypeTest extends BaseCase
{
    public function testGetName(): void
    {
        $type = new EmailValueObjectType();

        $this->assertSame(ValueObjectType::EMAIL->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = 'test@example.com';

        $type = new EmailValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new EmailValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = 'test@example.com';
        $valueObject = new EmailValueObject($value);

        $type = new EmailValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new EmailValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new EmailValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
