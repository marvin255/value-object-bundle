<?php

declare(strict_types=1);

namespace Marvin255\DoctrineTranslationBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Marvin255\DoctrineTranslationBundle\ValueObjectType;
use Marvin255\ValueObject\IntNonNegativeValueObject;

/**
 * Type for IntNonNegativeValueObject.
 *
 * @internal
 */
final class IntNonNegativeValueObjectType extends IntegerType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IntNonNegativeValueObject
    {
        if ($value === null) {
            return null;
        }

        return new IntNonNegativeValueObject((int) $value);
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

        if (!$value instanceof IntNonNegativeValueObject) {
            throw new \InvalidArgumentException('Invalid value');
        }

        return $value->getValue();
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function getName(): string
    {
        return ValueObjectType::NON_NEGATIVE_INTEGER->value;
    }
}
