<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests\Type;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Marvin255\ValueObject\PercentageValueObject;
use Marvin255\ValueObjectBundle\Tests\BaseCase;
use Marvin255\ValueObjectBundle\Type\PercentageValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class PercentageValueObjectTypeTest extends BaseCase
{
    public function testGetSQLDeclaration(): void
    {
        $type = new PercentageValueObjectType();
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
        $type = new PercentageValueObjectType();

        $this->assertSame(ParameterType::STRING, $type->getBindingType());
    }

    public function testGetName(): void
    {
        $type = new PercentageValueObjectType();

        $this->assertSame(ValueObjectType::PERCENTAGE->value, $type->getName());
    }

    public function testConvertToPHPValue(): void
    {
        $value = 50.5;

        $type = new PercentageValueObjectType();
        $converted = $type->convertToPHPValue($value, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted?->getValue());
    }

    public function testConvertToPHPValueNull(): void
    {
        $type = new PercentageValueObjectType();
        $converted = $type->convertToPHPValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValue(): void
    {
        $value = 50.5;
        $valueObject = new PercentageValueObject($value);

        $type = new PercentageValueObjectType();
        $converted = $type->convertToDatabaseValue($valueObject, $this->createAbstarctPlatformMock());

        $this->assertSame($value, $converted);
    }

    public function testConvertToDatabaseValueNull(): void
    {
        $type = new PercentageValueObjectType();
        $converted = $type->convertToDatabaseValue(null, $this->createAbstarctPlatformMock());

        $this->assertNull($converted);
    }

    public function testConvertToDatabaseValueInvalid(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value');

        $type = new PercentageValueObjectType();
        $type->convertToDatabaseValue('invalid', $this->createAbstarctPlatformMock());
    }
}
