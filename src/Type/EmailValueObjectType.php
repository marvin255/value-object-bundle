<?php

declare(strict_types=1);

namespace Marvin255\DoctrineTranslationBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Marvin255\DoctrineTranslationBundle\ValueObjectType;
use Marvin255\ValueObject\EmailValueObject;

/**
 * Type for EmailValueObject.
 *
 * @internal
 */
final class EmailValueObjectType extends StringType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?EmailValueObject
    {
        if ($value === null) {
            return null;
        }

        return new EmailValueObject((string) $value);
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

        if (!$value instanceof EmailValueObject) {
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
        return ValueObjectType::EMAIL->value;
    }
}
