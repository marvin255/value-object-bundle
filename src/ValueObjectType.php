<?php

declare(strict_types=1);

namespace Marvin255\DoctrineTranslationBundle;

use Marvin255\DoctrineTranslationBundle\Type\EmailValueObjectType;
use Marvin255\DoctrineTranslationBundle\Type\FileInfoValueObjectType;
use Marvin255\DoctrineTranslationBundle\Type\IntValueObjectType;
use Marvin255\DoctrineTranslationBundle\Type\StringNonEmptyValueObjectType;
use Marvin255\DoctrineTranslationBundle\Type\StringValueObjectType;
use Marvin255\DoctrineTranslationBundle\Type\UriValueObjectType;

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
    case NON_NEGATIVE_INTEGER = self::PREFIX . 'non_negative_integer';

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
        ];
    }
}
