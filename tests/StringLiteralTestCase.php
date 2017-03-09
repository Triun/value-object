<?php

use Triun\ValueObject\ValueObject;
use Triun\ValueObject\InvalidNativeArgumentException;

abstract class StringLiteralTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \ReflectionProperty
     */
    protected $valueProperty;

    /**
     * Setup
     *
     * Initialise $valueProperty to grand access to the StringLiteral::$value property.
     */
    protected function setUp()
    {
        $class = new ReflectionClass(StringLiteral::class);
        $this->valueProperty = $class->getProperty('value');
        $this->valueProperty->setAccessible(true);
    }

    /**
     * Gets StringLiteral value
     * @param StringLiteral $stringLiteral
     *
     * @return mixed
     */
    protected function getValue(StringLiteral $stringLiteral)
    {
        return $this->valueProperty->getValue($stringLiteral);
    }
}

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
