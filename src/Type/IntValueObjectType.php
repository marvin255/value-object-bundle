<?php

declare(strict_types=1);

namespace Marvin255\DoctrineTranslationBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Marvin255\DoctrineTranslationBundle\ValueObjectType;
use Marvin255\ValueObject\IntValueObject;

/**
 * Type for IntValueObject.
 *
 * @internal
 */
final class IntValueObjectType extends IntegerType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IntValueObject
    {
        if ($value === null) {
            return null;
        }

        return new IntValueObject((int) $value);
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

        if (!$value instanceof IntValueObject) {
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
        return ValueObjectType::INTEGER->value;
    }
}
