# Value objects bundle

[![Latest Stable Version](https://poser.pugx.org/marvin255/value-object-bundle/v)](https://packagist.org/packages/marvin255/value-object-bundle)
[![Total Downloads](https://poser.pugx.org/marvin255/value-object-bundle/downloads)](https://packagist.org/packages/marvin255/value-object-bundle)
[![License](https://poser.pugx.org/marvin255/value-object-bundle/license)](https://packagist.org/packages/marvin255/value-object-bundle)
[![Build Status](https://github.com/marvin255/value-object-bundle/workflows/marvin255_value_object_bundle/badge.svg)](https://github.com/marvin255/value-object-bundle/actions?query=workflow%3A%22marvin255_value_object_bundle%22)

Symfony bundle that provides Doctrine types for common value objects such as Email, Uri, String, Integer, and FileInfo.

## Installation

Install the package via Composer:

```bash
composer require marvin255/value-object-bundle
```

## Configuration

Add the bundle to your `config/bundles.php` (if not done automatically):

```php
return [
    // ...
    Marvin255\ValueObjectBundle\Marvin255ValueObjectBundle::class => ['all' => true],
];
```

## Usage

The bundle provides Doctrine DBAL types that automatically convert database values to value objects and vice versa.

### Supported Value Object Types

- `marvin255_string` - StringValueObject
- `marvin255_non_empty_string` - StringNonEmptyValueObject
- `marvin255_email` - EmailValueObject
- `marvin255_uri` - UriValueObject
- `marvin255_file_info` - FileInfoValueObject
- `marvin255_integer` - IntValueObject
- `marvin255_positive_integer` - IntPositiveValueObject
- `marvin255_negative_integer` - IntNegativeValueObject
- `marvin255_non_negative_integer` - IntNonNegativeValueObject
- `marvin255_non_positive_integer` - IntNonPositiveValueObject
- `marvin255_float` - FloatValueObject
- `marvin255_percentage` - PercentageValueObject
- `marvin255_bc_math_number` - BcMathNumberValueObject (requires bcmath PHP extension)

### Optional Types

Some types are only available when their corresponding PHP extensions are installed:

#### BcMath Type (marvin255_bc_math_number)

The `BcMathNumberValueObject` type provides arbitrary-precision decimal arithmetic using PHP's bcmath extension. It's automatically registered only if the `bcmath` extension is enabled.

To enable bcmath on your PHP installation, ensure it's installed and uncommented in `php.ini`:

```ini
extension=bcmath
```

If the extension is not available, the type will not be registered but the rest of the bundle will continue to function normally.

### Define Entity Properties

Use the Doctrine types in your entity mapping:

```php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Marvin255\ValueObject\EmailValueObject;
use Marvin255\ValueObject\StringValueObject;

#[ORM\Entity]
class User
{
    #[ORM\Column(type: 'marvin255_string')]
    private ?StringValueObject $name = null;

    #[ORM\Column(type: 'marvin255_email')]
    private EmailValueObject $email;

    public function setEmail(EmailValueObject $email): void
    {
        $this->email = $email;
    }

    public function getEmail(): EmailValueObject
    {
        return $this->email;
    }
}
```

### Working with Value Objects

Create and work with value objects naturally in your code:

```php
use Marvin255\ValueObject\EmailValueObject;
use Marvin255\ValueObject\StringValueObject;

$email = new EmailValueObject('user@example.com');
$name = new StringValueObject('John Doe');

$user->setEmail($email);
$user->setName($name);

$repository->save($user);
```

The bundle automatically handles conversion between value objects and their database representations.
