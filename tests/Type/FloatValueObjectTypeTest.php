<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Marvin255\ValueObject\FloatValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\FloatValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class FloatValueObjectTypeTest extends BaseCase
{
    public function testGetSQLDeclaration(): void
    {
        $type = new FloatValueObjectType();
        $column = ['name' => 'test_column'];

        $platform = $this->getMockBuilder(AbstractPlatform::class)->getMock();
        $platform->expects($this->once())
            ->method('getFloatDeclarationSQL')
            ->with($column)
            ->willReturn('FLOAT');

        $this->assertSame('FLOAT', $type->getSQLDeclaration($column, $platform));
    }

    public function testGetBindingType(): void
    {
        $type = new FloatValueObjectType();

        $this->assertSame(ParameterType::STRING, $type->getBindingType());
    }

    public function testGetName(): void
    {
        $type = new FloatValueObjectType();

        $this->assertSame(ValueObjectType::FLOAT->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = 123.45;

        $type = new FloatValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new FloatValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = 123.45;
        $valueObject = new FloatValueObject($value);

        $type = new FloatValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new FloatValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new FloatValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
