<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Marvin255\ValueObject\IntNegativeValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\IntNegativeValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class IntNegativeValueObjectTypeTest extends BaseCase
{
    public function testGetSQLDeclaration(): void
    {
        $type = new IntNegativeValueObjectType();
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
        $type = new IntNegativeValueObjectType();

        $this->assertSame(ParameterType::INTEGER, $type->getBindingType());
    }

    public function testGetName(): void
    {
        $type = new IntNegativeValueObjectType();

        $this->assertSame(ValueObjectType::NEGATIVE_INTEGER->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = -123;

        $type = new IntNegativeValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new IntNegativeValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = -123;
        $valueObject = new IntNegativeValueObject($value);

        $type = new IntNegativeValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new IntNegativeValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new IntNegativeValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
