<?php

declare(strict_types=1);

namespace Marvin255\DoctrineTranslationBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Marvin255\DoctrineTranslationBundle\ValueObjectType;
use Marvin255\ValueObject\StringValueObject;

/**
 * Type for StringValueObject.
 *
 * @internal
 */
final class StringValueObjectType extends StringType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?StringValueObject
    {
        if ($value === null) {
            return null;
        }

        if (!\is_string($value)) {
            throw new \InvalidArgumentException('Invalid value for StringType');
        }

        return new StringValueObject($value);
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

        if (!$value instanceof StringValueObject) {
            throw new \InvalidArgumentException('Invalid value for StringType');
        }

        return $value->getValue();
    }

    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function getName(): string
    {
        return ValueObjectType::STRING->value;
    }
}
