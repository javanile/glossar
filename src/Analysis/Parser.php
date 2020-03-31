<?php

namespace Glossarize\Analysis;

use Glossarize\Analysis\Parsers\PhpParser;

class Parser
{
    /**
     *
     */
    public function getArrayStringValues($file)
    {
        return PhpParser::getArrayStringValues($file);
    }
}
