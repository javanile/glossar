<?php

namespace Glossarize\Analysis\Parsers;

use Glossarize\Analysis\Parsers\PhpParser;

class DefaultParser
{
    /**
     *
     */
    public function getArrayStringValues($file)
    {
        return PhpParser::getArrayStringValues($file);
    }

    /**
     *
     */
    public function getGlossaryWords($file)
    {
        return PhpParser::getGlossaryWords($file);
    }
}
