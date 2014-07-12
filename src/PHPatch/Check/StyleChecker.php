<?php

namespace PHPatch\Check;

interface StyleChecker
{
    public function findErrors($filename);
}
