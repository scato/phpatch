<?php

namespace spec\PHPatch\Peg;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenIteratorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith("<?php\n\necho 'test';\n");
    }

    function it_consumes_tokens()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, "<?php\n", 1));
        $this->next()->shouldReturn(array(T_WHITESPACE, "\n", 2));
        $this->next()->shouldReturn(array(T_ECHO, 'echo', 3));
    }

    function it_has_a_position()
    {
        $this->pos()->shouldReturn(0);
        $this->next();
        $this->pos()->shouldReturn(1);
    }

    function it_can_backtrack()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, "<?php\n", 1));
        $this->rewind(0);
        $this->next()->shouldReturn(array(T_OPEN_TAG, "<?php\n", 1));
    }

    function it_should_return_null_after_the_end()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, "<?php\n", 1));
        $this->next()->shouldReturn(array(T_WHITESPACE, "\n", 2));
        $this->next()->shouldReturn(array(T_ECHO, 'echo', 3));
        $this->next()->shouldReturn(array(T_WHITESPACE, ' ', 3));
        $this->next()->shouldReturn(array(T_CONSTANT_ENCAPSED_STRING, "'test'", 3));
        $this->next()->shouldReturn(';');
        $this->next()->shouldReturn(array(T_WHITESPACE, "\n", 3));
        $this->next()->shouldReturn(null);
    }

    function it_should_calculate_a_line_number()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, "<?php\n", 1));
        $this->next()->shouldReturn(array(T_WHITESPACE, "\n", 2));
        $this->next()->shouldReturn(array(T_ECHO, 'echo', 3));

        $this->line()->shouldReturn(3);
    }

    function it_should_calculate_a_char_number()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, "<?php\n", 1));
        $this->next()->shouldReturn(array(T_WHITESPACE, "\n", 2));
        $this->next()->shouldReturn(array(T_ECHO, 'echo', 3));
        $this->next()->shouldReturn(array(T_WHITESPACE, ' ', 3));

        $this->char()->shouldReturn(5);
    }
}
