<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Type;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Marvin255\ValueObject\FloatValueObject;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * Type for FloatValueObject.
 *
 * @internal
 */
final class FloatValueObjectType extends Type
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getFloatDeclarationSQL($column);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getBindingType(): ParameterType
    {
        return ParameterType::STRING;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?FloatValueObject
    {
        if ($value === null) {
            return null;
        }

        return new FloatValueObject((float) $value);
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?float
    {
        if ($value === null) {
            return null;
        }

        if (!$value instanceof FloatValueObject) {
            throw new \InvalidArgumentException('Invalid value');
        }

        return $value->getValue();
    }

    public function getName(): string
    {
        return ValueObjectType::FLOAT->value;
    }
}
