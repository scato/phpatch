<?php

namespace PHPatch\Fix;

use PHPatch\Peg\Any;
use PHPatch\Peg\Choice;
use PHPatch\Peg\Literal;
use PHPatch\Peg\Map;
use PHPatch\Peg\Match;
use PHPatch\Peg\NotPredicate;
use PHPatch\Peg\Optional;
use PHPatch\Peg\Sequence;
use PHPatch\Peg\TokenIterator;
use PHPatch\Peg\Type;

class BracesFixer
{
    private $parser;

    /*
     * head : (
     *     T_CLASS
     *     (
     *         ! ( T_WHITESPACE ? “{“ )
     *         /(.*)/
     *     ) *
     * )
     * T_WHITESPACE ? “{“
     * {
     *     array_merge($head, [[T_WHITESPACE, “\n”], “{“])
     * }
     */
    public function __construct()
    {
        $head = new Sequence(
            new Type(T_CLASS),
            new Any(new Sequence(
                new NotPredicate(new Sequence(new Optional(new Type(T_WHITESPACE)), new Literal("{"))),
                new Match('.*')
            ))
        );
        $brace = new Sequence(
            new Optional(new Type(T_WHITESPACE)),
            new Literal("{")
        );
        $expr = 'array_merge($head, [[T_WHITESPACE, "\n", 1], "{"])';

        $findReplace = new Map(array('head' => $head, $brace), $expr);

        $this->parser = new Any(new Choice($findReplace, new Match('.*')));
    }

    public function fixErrors($string)
    {
        $input = new TokenIterator($string);
        $output = $this->parser->parse($input);

        return $output->createString();
    }
}
