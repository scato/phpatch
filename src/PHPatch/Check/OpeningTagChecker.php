<?php

namespace PHPatch\Check;

use PHPatch\Peg\Any;
use PHPatch\Peg\Choice;
use PHPatch\Peg\Definition\Input;
use PHPatch\Peg\Definition\Parser;
use PHPatch\Peg\Map;
use PHPatch\Peg\Match;
use PHPatch\Peg\TokenIterator;

class OpeningTagChecker implements StyleChecker
{
    private $parser;

    public function __construct()
    {
        $definition = '& T_OPEN_TAG "<?" { [[$iterator->line(), $iterator->char()]] }';

        $definitionParser = new Parser();
        $find = $definitionParser->parse(new Input($definition))->getValue();

        $this->parser = new Any(new Choice($find, new Map(array(new Match('.*')), '[]')));
    }

    /**
     * @param string $string
     * @return StyleError[]
     */
    public function findErrors($string)
    {
        ini_set('short_open_tag', 'On');

        $input = new TokenIterator($string);
        $output = $this->parser->parse($input);

        return array_map(function ($match) {
            return new StyleError('Use ONLY <?php and <?= tags', $match[0], $match[1]);
        }, $output->getValue());
    }
}
