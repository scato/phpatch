<?php

namespace spec\PHPatch\Check;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class StyleErrorSpec extends ObjectBehavior
{
    const FILENAME = 'test.php';
    const LINE = 42;
    const CHAR = 5;
    const MESSAGE = 'You SHOULD do this';

    function let()
    {
        $this->beConstructedWith(self::FILENAME, self::LINE, self::CHAR, self::MESSAGE);
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
