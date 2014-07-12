<?php

namespace PHPatch\Fix;

use PHPatch\Peg\Any;
use PHPatch\Peg\Choice;
use PHPatch\Peg\Definition\Input;
use PHPatch\Peg\Definition\Parser;
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

    public function __construct()
    {
        $definition = <<<EOS
            head : (
                T_CLASS
                (
                    ! ( T_WHITESPACE ? "{" )
                    .
                ) *
            )
            T_WHITESPACE ? "{"
            {
                array_merge(\$head, [[T_WHITESPACE, "\\n", 1], "{"])
            }
EOS;

        $definitionParser = new Parser();
        $findReplace = $definitionParser->parse(new Input($definition))->getValue();

        $this->parser = new Any(new Choice($findReplace, new Match('.*')));
    }

    public function fixErrors($string)
    {
        $input = new TokenIterator($string);
        $output = $this->parser->parse($input);

        return $output->createString();
    }
}
