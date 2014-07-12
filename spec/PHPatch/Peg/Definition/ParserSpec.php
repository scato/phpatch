<?php

namespace spec\PHPatch\Peg\Definition;

use PHPatch\Peg\AndPredicate;
use PHPatch\Peg\Any;
use PHPatch\Peg\Choice;
use PHPatch\Peg\Definition\Failure;
use PHPatch\Peg\Definition\Input;
use PHPatch\Peg\Definition\Success;
use PHPatch\Peg\Literal;
use PHPatch\Peg\Many;
use PHPatch\Peg\Map;
use PHPatch\Peg\Match;
use PHPatch\Peg\NotPredicate;
use PHPatch\Peg\Optional;
use PHPatch\Peg\Sequence;
use PHPatch\Peg\Type;
use PHPatch\Peg\Void;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ParserSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('PHPatch\Peg\Definition\Parser');
    }

    function it_should_parse_type()
    {
        $this->parse(new Input('T_OPEN_TAG'))->shouldBeLike(new Success(new Type(T_OPEN_TAG)));
    }

    function it_should_parse_literal()
    {
        $this->parse(new Input('"foo"'))->shouldBeLike(new Success(new Literal("foo")));
    }

    function it_should_parse_one()
    {
        $this->parse(new Input('.'))->shouldBeLike(new Success(new Match(".*")));
    }

    function it_should_parse_sequence()
    {
        $this->parse(new Input('T_STRING "foo"'))->shouldBeLike(new Success(new Sequence(new Type(T_STRING), new Literal("foo"))));
    }

    function it_should_parse_choice()
    {
        $this->parse(new Input('T_STRING / "foo"'))->shouldBeLike(new Success(new Choice(new Type(T_STRING), new Literal("foo"))));
    }

    function it_should_parse_and_predicate()
    {
        $this->parse(new Input('& T_STRING'))->shouldBeLike(new Success(new AndPredicate(new Type(T_STRING))));
    }

    function it_should_parse_not_predicate()
    {
        $this->parse(new Input('! T_STRING'))->shouldBeLike(new Success(new NotPredicate(new Type(T_STRING))));
    }

    function it_should_parse_any()
    {
        $this->parse(new Input('T_STRING *'))->shouldBeLike(new Success(new Any(new Type(T_STRING))));
    }

    function it_should_parse_many()
    {
        $this->parse(new Input('T_STRING +'))->shouldBeLike(new Success(new Many(new Type(T_STRING))));
    }

    function it_should_parse_optional()
    {
        $this->parse(new Input('T_STRING ?'))->shouldBeLike(new Success(new Optional(new Type(T_STRING))));
    }

    function it_should_parse_void()
    {
        $this->parse(new Input('()'))->shouldBeLike(new Success(new Void()));
    }

    function it_should_parse_map()
    {
        $this->parse(new Input('key : T_STRING T_WHITESPACE value : T_STRING { array($key => $value) }'))
            ->shouldBeLike(new Success(new Map(
                    array('key' => new Type(T_STRING), new Type(T_WHITESPACE), 'value' => new Type(T_STRING)),
                    'array($key => $value)'
            )));
    }

    function it_should_fail_on_too_much_input()
    {
        $this->parse(new Input('T_STRING /'))->shouldBeLike(new Failure('Unexpected \'/\' at line 1, char 11'));
    }
}
