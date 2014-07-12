<?php

namespace PHPatch\Peg;

class Map implements Parser
{
    private $parts; // pun not intended
    private $expr;

    public function __construct(array $parts, $expr)
    {
        $this->parts = $parts;
        $this->expr = $expr;
    }

    public function parse(TokenIterator $iterator)
    {
        $params = array();

        foreach ($this->parts as $label => $part) {
            $result = $part->parse($iterator);

            if ($result instanceof Failure) {
                return $result;
            }

            if (is_string($label)) {
                $params[$label] = $result->getValue();
            }
        }

        return new Success($this->evalExpr($params, $iterator));
    }

    private function evalExpr(array $params, TokenIterator $iterator)
    {
        $argList = array();

        foreach (array_keys($this->parts) as $label) {
            if (is_string($label)) {
                $argList[] = '$' . $label;
            }
        }

        $argList[] = '$iterator';
        $params[] = $iterator;

        $args = implode(', ', $argList);
        $code = "return ({$this->expr});";
        $callback = create_function($args, $code);

        return call_user_func_array($callback, $params);
    }
}
