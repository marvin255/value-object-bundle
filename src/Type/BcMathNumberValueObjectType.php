<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\TextType;
use Marvin255\ValueObject\BcMathNumberValueObject;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * Type for BcMathNumberValueObject.
 *
 * @internal
 */
final class BcMathNumberValueObjectType extends TextType
{
    /**
     * {@inheritdoc}
     */
    #[\Override]
    public function convertToPHPValue($value, AbstractPlatform $platform): ?BcMathNumberValueObject
    {
        if ($value === null) {
            return null;
        }

        return new BcMathNumberValueObject((string) $value);
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

        if (!$value instanceof BcMathNumberValueObject) {
            throw new \InvalidArgumentException('Invalid value');
        }

        return (string) $value->getValue();
    }

    public function getName(): string
    {
        return ValueObjectType::BC_MATH_NUMBER->value;
    }
}
