<?php
use Triun\ValueObject\InvalidNativeArgumentException;

class InvalidNativeArgumentExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException     \Triun\ValueObject\InvalidNativeArgumentException
     * @expectedExceptionCode 0
     */
    public function testExceptionHasRightCode()
    {
        throw new InvalidNativeArgumentException('name', ['string', 'object']);
    }

    /**
     * @test
     * @expectedException        \Triun\ValueObject\InvalidNativeArgumentException
     * @expectedExceptionMessage  is invalid. Allowed types for argument are
     */
    public function Exception_contains_text()
    {
        throw new InvalidNativeArgumentException('name', ['string', 'object']);
    }

    /**
     * @test
     * @dataProvider typesProvider
     * @depends      Exception_contains_text
     * @expectedException              \Triun\ValueObject\InvalidNativeArgumentException
     * @expectedExceptionMessageRegExp #Argument type ".*" is invalid. Allowed types for argument are "[\w, ]*".#
     *
     * @param mixed    $value
     * @param string[] $allowed_types
     * @param string   $message
     */
    public function Exception_message_matches_RegExp($value, $allowed_types, $message)
    {
//        $this->setExpectedExceptionRegExp(
//            InvalidNativeArgumentException::class,
//            '#Argument type ".*" is invalid. Allowed types for argument are "[\w, ]*".#'
//        );

        throw new InvalidNativeArgumentException($value, $allowed_types);
    }

    /**
     * @test
     * @dataProvider typesProvider
     * @depends Exception_message_matches_RegExp
     * @expectedException        \Triun\ValueObject\InvalidNativeArgumentException
     *
     * @param mixed    $value
     * @param string[] $allowed_types
     * @param string   $message
     */
    public function Exception_is_text_generated_with_value_and_expecting_types_array($value, $allowed_types, $message)
    {
        $this->setExpectedException(
            InvalidNativeArgumentException::class,
            $message,
            0
        );

        throw new InvalidNativeArgumentException($value, $allowed_types);
    }

    /**
     * @return array
     * @link http://php.net/manual/en/language.types.intro.php
     */
    public function typesProvider()
    {
        return [
            // scalar types:
            'boolean' => [
                true,
                ['string', 'object'],
                'Argument type "boolean" is invalid. Allowed types for argument are "string", "object".'
            ],
            'integer' => [
                1,
                ['string', 'object'],
                'Argument type "integer" is invalid. Allowed types for argument are "string", "object".'
            ],
            'float' => [
                1.3,
                ['string', 'object'],
                'Argument type "double" is invalid. Allowed types for argument are "string", "object".'
            ],
            'string' => [
                'foo',
                ['string', 'object'],
                'Argument type "string" is invalid. Allowed types for argument are "string", "object".'
            ],

            // compound types:
            'array' => [
                ['foo', 'bar'],
                ['string', 'object'],
                'Argument type "array" is invalid. Allowed types for argument are "string", "object".'
            ],
            'object' => [
                new stdClass,
                ['string', 'object'],
                'Argument type "object" is invalid. Allowed types for argument are "string", "object".'
            ],
            'callable' => [
                function() {},
                ['string', 'object'],
                'Argument type "object" is invalid. Allowed types for argument are "string", "object".'
            ],

            // special types:
//            'resource' => com_load(),
            'null' => [
                null,
                ['string', 'object'],
                'Argument type "NULL" is invalid. Allowed types for argument are "string", "object".'
            ],
        ];
    }
}