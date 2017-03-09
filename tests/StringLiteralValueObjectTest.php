<?php

class StringLiteralValueObjectTest extends StringLiteralTestCase
{
    /**
     * @test
     * @dataProvider stringProvider
     *
     * @param string $string_1
     * @param string $string_2
     */
    public function constructor_fills_native_value($string_1, $string_2)
    {
        $this->assertEquals(
            $string_1,
            $this->getValue(new StringLiteral($string_1))
        );

        $this->assertEquals(
            $string_2,
            $this->getValue(new StringLiteral($string_2))
        );
    }

    /**
     * @test
     * @depends constructor_fills_native_value
     * @dataProvider stringProvider
     *
     * @param string         $string_1
     * @param string         $string_2
     */
    public function fromNative_fills_native_value($string_1, $string_2)
    {
        $this->assertEquals(
            $string_1,
            $this->getValue(StringLiteral::fromNative($string_1))
        );

        $this->assertEquals(
            $string_2,
            $this->getValue(StringLiteral::fromNative($string_2))
        );
    }

    /**
     * @test
     * @depends fromNative_fills_native_value
     * @dataProvider nonStringProvider
     * @expectedException        \Triun\ValueObject\InvalidNativeArgumentException
     *
     * @param mixed $nonString
     */
    public function non_strings_trhows_InvalidNativeArgumentException($nonString)
    {
        $stringLiteral = StringLiteral::fromNative($nonString);
    }

    /**
     * @test
     * @depends fromNative_fills_native_value
     * @dataProvider stringProvider
     *
     * @param string         $string_1
     * @param string         $string_2
     */
    public function it_gets_native_value($string_1, $string_2)
    {
        //$this->assertEquals([], func_get_args());

        $stringLiteral_1 = StringLiteral::fromNative($string_1);
        $stringLiteral_2 = StringLiteral::fromNative($string_2);

        $this->assertEquals(
            $string_1,
            $stringLiteral_1->toNative()
        );

        $this->assertEquals(
            $string_2,
            $stringLiteral_2->toNative()
        );
    }

    /**
     * @test
     * @dataProvider stringProvider
     * @depends it_gets_native_value
     *
     * @param string         $string_1
     * @param string         $string_2
     */
    public function it_casts_to_string($string_1, $string_2)
    {
        $stringLiteral_1 = StringLiteral::fromNative($string_1);
        $stringLiteral_2 = StringLiteral::fromNative($string_2);

        $this->assertEquals(
            $string_1,
            (string) $stringLiteral_1
        );

        $this->assertEquals(
            $string_2,
            (string) $stringLiteral_2
        );

        $this->assertEquals(
            "$string_1",
            "$stringLiteral_1"
        );

        $this->assertEquals(
            "$string_2",
            "$stringLiteral_2"
        );

        $this->assertEquals(
            $string_1 . $string_2,
            $stringLiteral_1 . $stringLiteral_2
        );
    }

    /**
     * @test
     * @dataProvider stringProvider
     * @depends it_gets_native_value
     *
     * @param string         $string_1
     * @param string         $string_2
     */
    public function it_can_be_compared_with_a_string($string_1, $string_2)
    {
        $stringLiteral_1 = StringLiteral::fromNative($string_1);
        $stringLiteral_2 = StringLiteral::fromNative($string_2);

        $this->assertEquals(
            $string_1,
            $stringLiteral_1
        );

        $this->assertEquals(
            $string_2,
            $stringLiteral_2
        );
    }

    /**
     * @test
     * @dataProvider stringProvider
     * @depends it_gets_native_value
     *
     * @param string         $string_1
     * @param string         $string_2
     */
    public function equals_method_can_compared_another_value_object($string_1, $string_2)
    {
        $stringLiteral_1 = StringLiteral::fromNative($string_1);
        $stringLiteral_2 = StringLiteral::fromNative($string_2);

        $this->assertTrue(
            $stringLiteral_1->equals(StringLiteral::fromNative($string_1))
        );

        $this->assertFalse(
            $stringLiteral_2->equals($stringLiteral_1)
        );
    }

    /**
     * @test
     * @dataProvider stringProvider
     * @depends it_gets_native_value
     *
     * @param string         $string_1
     * @param string         $string_2
     */
    public function it_can_be_compared_with_another_value_object($string_1, $string_2)
    {
        $stringLiteral_1a = StringLiteral::fromNative($string_1);
        $stringLiteral_1b = StringLiteral::fromNative($string_1);
        $stringLiteral_2 = StringLiteral::fromNative($string_2);

        $this->assertEquals(
            $stringLiteral_1a,
            $stringLiteral_1b
        );

        $this->assertNotEquals(
            $stringLiteral_1a,
            $stringLiteral_2
        );

        $this->assertTrue(
            $stringLiteral_1a == $stringLiteral_1b
        );

        $this->assertFalse(
            $stringLiteral_1a == $stringLiteral_2
        );
    }

    /**
     * @test
     * @dataProvider stringProvider
     * @depends it_gets_native_value
     *
     * @param string         $string_1
     * @param string         $string_2
     */
    public function it_will_not_be_Identical_to_another_value_object_which_has_same_value($string_1, $string_2)
    {
        $stringLiteral_1a = StringLiteral::fromNative($string_1);
        $stringLiteral_1b = StringLiteral::fromNative($string_1);
        $stringLiteral_2 = StringLiteral::fromNative($string_2);

        $this->assertTrue(
            $stringLiteral_1a == $stringLiteral_1b
        );

        $this->assertFalse(
            $stringLiteral_1a == $stringLiteral_2
        );

        $this->assertFalse(
            $stringLiteral_1a === $stringLiteral_1b
        );

        $this->assertFalse(
            $stringLiteral_1a === $stringLiteral_2
        );
    }

    /**
     * @return array
     */
    public function stringProvider()
    {
        return [
            'word'  => ['foo', 'bar'],
            'sentence' => [
                'Mollis Parturient Fringilla',
                'Condimentum Ridiculus Pharetra',
            ],
            'multi line' => [
                "Cras justo odio,\ndapibus ac facilisis in,\negestas eget quam.",
                "Lorem ipsum dolor sit amet,\nconsectetur adipiscing elit.",
            ],
            'special characters'  => [
                '[qxBGlD/B+juL"V',
                '^$"}BO``{=j{_n',
            ]
        ];
    }

    /**
     * @return array
     * @link http://php.net/manual/en/language.types.intro.php
     */
    public function nonStringProvider()
    {
        return [
            // scalar types:
            'boolean' => [true],
            'integer' => [1],
            'float' => [1.3],

            // compound types:
            'array' => [['foo', 'bar']],
            'object' => [new stdClass],
            'callable' => [ function() {}],

            // special types:
//            'resource' => com_load(),
            'null' => [null],
        ];
    }
}
