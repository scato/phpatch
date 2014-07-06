<?php

namespace spec\PHPatch\Peg;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TokenIteratorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('<?php echo "test";');
    }

    function it_consumes_tokens()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, '<?php ', 1));
        $this->next()->shouldReturn(array(T_ECHO, 'echo', 1));
    }

    function it_has_a_position()
    {
        $this->pos()->shouldReturn(0);
        $this->next();
        $this->pos()->shouldReturn(1);
    }

    function it_can_backtrack()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, '<?php ', 1));
        $this->rewind(0);
        $this->next()->shouldReturn(array(T_OPEN_TAG, '<?php ', 1));
    }

    function it_returns_null_after_the_end()
    {
        $this->next()->shouldReturn(array(T_OPEN_TAG, '<?php ', 1));
        $this->next()->shouldReturn(array(T_ECHO, 'echo', 1));
        $this->next()->shouldReturn(array(T_WHITESPACE, ' ', 1));
        $this->next()->shouldReturn(array(T_CONSTANT_ENCAPSED_STRING, '"test"', 1));
        $this->next()->shouldReturn(';');
        $this->next()->shouldReturn(null);
    }
}
