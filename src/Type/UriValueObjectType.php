<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Marvin255\ValueObject\UriValueObject;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * Type for UriValueObject.
 *
 * @internal
 */
final class UriValueObjectType extends StringType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?UriValueObject
    {
        if ($value === null) {
            return null;
        }

        return new UriValueObject((string) $value);
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToDatabaseValue($value, AbstractPlatform $platform): ?string
    {
        if ($value === null) {
            return null;
        }

        if (!$value instanceof UriValueObject) {
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
        return ValueObjectType::URI->value;
    }
}
