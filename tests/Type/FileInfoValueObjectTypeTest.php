<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Marvin255\ValueObject\FileInfoValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\FileInfoValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class FileInfoValueObjectTypeTest extends BaseCase
{
    public function testGetName(): void
    {
        $type = new FileInfoValueObjectType();

        $this->assertSame(ValueObjectType::FILE_INFO->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = '/path/to/file.txt';

        $type = new FileInfoValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new FileInfoValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = '/path/to/file.txt';
        $valueObject = new FileInfoValueObject($value);

        $type = new FileInfoValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new FileInfoValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new FileInfoValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
