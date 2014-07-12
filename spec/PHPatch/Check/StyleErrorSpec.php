<?php

namespace spec\PHPatch\Check;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StyleErrorSpec extends ObjectBehavior
{
    const MESSAGE = 'You SHOULD do this';
    const LINE = 42;
    const CHAR = 5;
    const FILENAME = 'test.php';

    function let()
    {
        $this->beConstructedWith(self::MESSAGE, self::LINE, self::CHAR, self::FILENAME);
    }

    function it_should_have_a_file_name()
    {
        $this->getFilename()->shouldBe(self::FILENAME);
    }

    function it_should_have_a_line_number()
    {
        $this->getLine()->shouldBe(self::LINE);
    }

    function it_should_have_a_char_position()
    {
        $this->getChar()->shouldBe(self::CHAR);
    }

    function it_should_have_an_error_message()
    {
        $this->getMessage()->shouldBe(self::MESSAGE);
    }
}
