# Value Object

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Pre Release Version on Packagist][ico-pre-release]][link-packagist]
[![Latest Unstable Version][ico-unstable]][link-packagist]
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]
[![Software License][ico-license]](LICENSE.md)

Value Object definition.

## About

PHP Class interface to define and standardise a Value Object format.

In computer science, a value object is a small object that represents a simple entity whose equality is not based on identity: i.e. two value objects are equal when they have the same value, not necessarily being the same object (Wikipedia).

## Installation

Require this package with composer using the following command:

```bash
composer require triun/value-object
```

## Description

The package contains a ValueObject interface:

```php
interface ValueObject
{
    /**
     * Returns a object taking PHP native value(s) as argument(s).
     *
     * @return \Triun\ValueObject\ValueObject
     */
    public static function fromNative();

    /**
     * Returns PHP native value(s)
     *
     * @return mixed
     */
    public function toNative();

    /**
     * Compare two ValueObjectInterface and tells whether they can be considered equal.
     *
     * @param \Triun\ValueObject\ValueObject $object
     *
     * @return mixed
     */
    public function equals(ValueObject $object);

    /**
     * Returns a string representation of the object.
     *
     * @return string
     */
    public function __toString();
}
```

And a Invalid Argument Exception:

```php
class InvalidNativeArgumentException extends \InvalidArgumentException
{
    /**
     * InvalidNativeArgumentException constructor.
     *
     * @param string $value
     * @param array  $allowed_types
     */
    public function __construct($value, array $allowed_types)
    {
        $this->message = sprintf(
            'Argument "%s" is invalid. Allowed types for argument are "%s".',
            $value,
            implode(', ', $allowed_types)
        );
    }
}
```

## Usage

Example of use for a single field ValueObject:

```php
use Triun\ValueObject\ValueObject;
use Triun\ValueObject\Exceptions\InvalidNativeArgumentException;

class StringLiteral implements ValueObject
{
    /**
     * Native string
     *
     * @var string
     */
    protected $value;
    
    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @internal param string $value
     * 
     * @return StringLiteral
     */
    public static function fromNative()
    {
        $value = func_get_arg(0);
        
        return new static($value);
    }
    
    /**
     * Returns a StringLiteral object given a PHP native string as parameter.
     *
     * @param string $value
     */
    public function __construct($value)
    {
        if (false === \is_string($value)) {
            throw new InvalidNativeArgumentException($value, array('string'));
        }
        
        $this->value = $value;
    }
    
    /**
     * Returns the value of the string
     *
     * @return string
     */
    public function toNative()
    {
        return $this->value;
    }
    
    /**
     * Tells whether two string literals are equal by comparing their values
     *
     * @param  ValueObject $stringLiteral
     * 
     * @return bool
     */
    public function equals(ValueObject $stringLiteral)
    {
        if (static::class !== get_class($stringLiteral)) {
            return false;
        }
        
        return $this->toNative() === $stringLiteral->toNative();
    }
    
    /**
     * Tells whether the StringLiteral is empty
     *
     * @return bool
     */
    public function isEmpty()
    {
        return \strlen($this->toNative()) == 0;
    }
    
    /**
     * Returns the string value itself
     *
     * @return string
     */
    public function __toString()
    {
        return $this->toNative();
    }
}
```


## Links

- Wikipedia: [Value Object](https://en.wikipedia.org/wiki/Value_object)
- Wikipedia: [Domain-Driven Design](https://en.wikipedia.org/wiki/Domain-driven_design)
- Culttt: [What is the difference between Entities and Value Objects?](http://culttt.com/2014/04/30/difference-entities-value-objects/)


## Issues
   
Bug reports and feature requests can be submitted on the [Github Issue Tracker](https://github.com/Triun/value-object/issues).

## Contributing

See [CONTRIBUTING.md](CONTRIBUTING.md) for information.

## License

The Laravel Model Base is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)


[ico-version]: https://img.shields.io/packagist/v/triun/value-object.svg
[ico-pre-release]: https://img.shields.io/packagist/vpre/triun/value-object.svg
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://travis-ci.org/Triun/value-object.svg?branch=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/triun/value-object.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/triun/value-object.svg?style=flat-square
[ico-unstable]: https://poser.pugx.org/triun/value-object/v/unstable

[link-packagist]: https://packagist.org/packages/triun/value-object
[link-travis]: https://travis-ci.org/Triun/value-object
[link-downloads]: https://packagist.org/packages/triun/value-object
[link-author]: https://github.com/triun