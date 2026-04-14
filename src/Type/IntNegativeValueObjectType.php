<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Type;

use Doctrine\DBAL\ParameterType;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;
use Marvin255\ValueObject\IntNegativeValueObject;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * Type for IntNegativeValueObject.
 *
 * @internal
 */
final class IntNegativeValueObjectType extends Type
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string
    {
        return $platform->getIntegerTypeDeclarationSQL($column);
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getBindingType(): ParameterType
    {
        return ParameterType::INTEGER;
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IntNegativeValueObject
    {
        if ($value === null) {
            return null;
        }

        return new IntNegativeValueObject((int) $value);
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?int
    {
        if ($value === null) {
            return null;
        }

        if (!$value instanceof IntNegativeValueObject) {
            throw new \InvalidArgumentException('Invalid value');
        }

        return $value->getValue();
    }

    public function getName(): string
    {
        return ValueObjectType::NEGATIVE_INTEGER->value;
    }
}
