<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle;

use Marvin255\ValueObjectBundle\Type\BcMathNumberValueObjectType;
use Marvin255\ValueObjectBundle\Type\EmailValueObjectType;
use Marvin255\ValueObjectBundle\Type\FileInfoValueObjectType;
use Marvin255\ValueObjectBundle\Type\FloatValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntNegativeValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntNonNegativeValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntNonPositiveValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntPositiveValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntValueObjectType;
use Marvin255\ValueObjectBundle\Type\PercentageValueObjectType;
use Marvin255\ValueObjectBundle\Type\StringNonEmptyValueObjectType;
use Marvin255\ValueObjectBundle\Type\StringValueObjectType;
use Marvin255\ValueObjectBundle\Type\UriValueObjectType;

/**
 * Enum for value object types.
 *
 * @internal
 */
enum ValueObjectType: string
{
    private const PREFIX = 'marvin255_';

    case STRING = self::PREFIX . 'string';
    case NON_EMPTY_STRING = self::PREFIX . 'non_empty_string';
    case EMAIL = self::PREFIX . 'email';
    case URI = self::PREFIX . 'uri';
    case FILE_INFO = self::PREFIX . 'file_info';
    case INTEGER = self::PREFIX . 'integer';
    case POSITIVE_INTEGER = self::PREFIX . 'positive_integer';
    case NEGATIVE_INTEGER = self::PREFIX . 'negative_integer';
    case NON_NEGATIVE_INTEGER = self::PREFIX . 'non_negative_integer';
    case NON_POSITIVE_INTEGER = self::PREFIX . 'non_positive_integer';
    case FLOAT = self::PREFIX . 'float';
    case PERCENTAGE = self::PREFIX . 'percentage';
    case BC_MATH_NUMBER = self::PREFIX . 'bc_math_number';

    /**
     * Get map of type names to class names.
     *
     * @psalm-return array<string, class-string>
     */
    public static function getNameToClassMap(): array
    {
        return [
            self::STRING->value => StringValueObjectType::class,
            self::NON_EMPTY_STRING->value => StringNonEmptyValueObjectType::class,
            self::EMAIL->value => EmailValueObjectType::class,
            self::URI->value => UriValueObjectType::class,
            self::FILE_INFO->value => FileInfoValueObjectType::class,
            self::INTEGER->value => IntValueObjectType::class,
            self::POSITIVE_INTEGER->value => IntPositiveValueObjectType::class,
            self::NEGATIVE_INTEGER->value => IntNegativeValueObjectType::class,
            self::NON_NEGATIVE_INTEGER->value => IntNonNegativeValueObjectType::class,
            self::NON_POSITIVE_INTEGER->value => IntNonPositiveValueObjectType::class,
            self::FLOAT->value => FloatValueObjectType::class,
            self::PERCENTAGE->value => PercentageValueObjectType::class,
            self::BC_MATH_NUMBER->value => BcMathNumberValueObjectType::class,
        ];
    }
}
