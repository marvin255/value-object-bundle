<?php

declare(strict_types=1);

namespace Marvin255\ValueObjectBundle\Tests;

use Marvin255\ValueObjectBundle\Type\EmailValueObjectType;
use Marvin255\ValueObjectBundle\Type\FileInfoValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntNonNegativeValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntPositiveValueObjectType;
use Marvin255\ValueObjectBundle\Type\IntValueObjectType;
use Marvin255\ValueObjectBundle\Type\StringNonEmptyValueObjectType;
use Marvin255\ValueObjectBundle\Type\StringValueObjectType;
use Marvin255\ValueObjectBundle\Type\UriValueObjectType;
use Marvin255\ValueObjectBundle\ValueObjectType;

/**
 * @internal
 */
final class ValueObjectTypeTest extends BaseCase
{
    public function testGetNameToClassMap(): void
    {
        $expected = [
            'marvin255_string' => StringValueObjectType::class,
            'marvin255_non_empty_string' => StringNonEmptyValueObjectType::class,
            'marvin255_email' => EmailValueObjectType::class,
            'marvin255_uri' => UriValueObjectType::class,
            'marvin255_file_info' => FileInfoValueObjectType::class,
            'marvin255_integer' => IntValueObjectType::class,
            'marvin255_positive_integer' => IntPositiveValueObjectType::class,
            'marvin255_non_negative_integer' => IntNonNegativeValueObjectType::class,
        ];

        $actual = ValueObjectType::getNameToClassMap();

        $this->assertSame($expected, $actual);
    }
}
