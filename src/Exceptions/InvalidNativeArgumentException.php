<?php

namespace Triun\ValueObject\Exceptions;

/**
 * Class InvalidNativeArgumentException
 * @package HW\ValueObjects
 */
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
