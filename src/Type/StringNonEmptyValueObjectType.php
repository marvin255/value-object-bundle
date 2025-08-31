<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Marvin255\ValueObject\StringNonEmptyValueObject;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * Type for StringNonEmptyValueObject.
 *
 * @internal
 */
final class StringNonEmptyValueObjectType extends StringType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?StringNonEmptyValueObject
    {
        if ($value === null) {
            return null;
        }

        return new StringNonEmptyValueObject((string) $value);
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

        if (!$value instanceof StringNonEmptyValueObject) {
            throw new \InvalidArgumentException('Invalid value');
        }

        return $value->getValue();
    }

    public function getName(): string
    {
        return ValueObjectType::NON_EMPTY_STRING->value;
    }
}
