<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Marvin255\ValueObject\IntNonPositiveValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\IntNonPositiveValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class IntNonPositiveValueObjectTypeTest extends BaseCase
{
    public function testGetSQLDeclaration(): void
    {
        $type = new IntNonPositiveValueObjectType();
        $column = ['name' => 'test_column'];

        $platform = $this->getMockBuilder(AbstractPlatform::class)->getMock();
        $platform->expects($this->once())
            ->method('getIntegerTypeDeclarationSQL')
            ->with($column)
            ->willReturn('INT(11)');

        $this->assertSame('INT(11)', $type->getSQLDeclaration($column, $platform));
    }

    public function testGetBindingType(): void
    {
        $type = new IntNonPositiveValueObjectType();

        $this->assertSame(ParameterType::INTEGER, $type->getBindingType());
    }

    public function testGetName(): void
    {
        $type = new IntNonPositiveValueObjectType();

        $this->assertSame(ValueObjectType::NON_POSITIVE_INTEGER->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = -123;

        $type = new IntNonPositiveValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueZero(): void
    {
        $value = 0;

        $type = new IntNonPositiveValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new IntNonPositiveValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = -123;
        $valueObject = new IntNonPositiveValueObject($value);

        $type = new IntNonPositiveValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new IntNonPositiveValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new IntNonPositiveValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
