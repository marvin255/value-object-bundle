<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Marvin255\ValueObject\FileInfoValueObject;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * Type for FileInfoValueObject.
 *
 * @internal
 */
final class FileInfoValueObjectType extends StringType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?FileInfoValueObject
    {
        if ($value === null) {
            return null;
        }

        return new FileInfoValueObject((string) $value);
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

        if (!$value instanceof FileInfoValueObject) {
            throw new \InvalidArgumentException('Invalid value');
        }

        return $value->getValue();
    }

    public function getName(): string
    {
        return ValueObjectType::FILE_INFO->value;
    }
}
