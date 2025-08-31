<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;
use Marvin255\ValueObject\IntPositiveValueObject;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * Type for IntPositiveValueObject.
 *
 * @internal
 */
final class IntPositiveValueObjectType extends IntegerType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?IntPositiveValueObject
    {
        if ($value === null) {
            return null;
        }

        return new IntPositiveValueObject((int) $value);
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

        if (!$value instanceof IntPositiveValueObject) {
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
        return ValueObjectType::POSITIVE_INTEGER->value;
    }
}
