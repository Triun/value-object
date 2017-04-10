<?php

namespace Triun\ValueObject;

/**
 * Class InvalidNativeArgumentException
 * @package HW\ValueObjects
 *
 * Exception thrown if a native argument does not match with the expected value.
 * (PHP 5 >= 5.1.0, PHP 7)
 * @link http://php.net/manual/en/class.invalidargumentexception.php
 *
 * @since 5.0
 */
class InvalidNativeArgumentException extends \InvalidArgumentException
{
    /**
     * InvalidNativeArgumentException constructor.
     *
     * @param string $value
     * @param array  $allowedTypes
     */
    public function __construct($value, array $allowedTypes)
    {
        $this->message = sprintf(
            'Argument type "%s" is invalid. Allowed types for argument are "%s".',
            gettype($value),
            implode('", "', $allowedTypes)
        );
    }
}
