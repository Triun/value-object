<?php

namespace Triun\ValueObject;

/**
 * Interface ValueObject
 * @package Triun\ValueObject
 *
 * @link http://php.net/manual/en/function.func-get-arg.php
 *
 * @since 4.0
 * @since 5.0
 */
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
