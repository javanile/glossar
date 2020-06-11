<?php

namespace Javanile\Glossar\Parsers;

use Glossarize\Analysis\Parsers\PhpParser;
use Stringy\StaticStringy as S;

class DefaultParser
{
    /**
     * @param mixed $file
     */
    public function getArrayStringValues($file)
    {
        return PhpParser::getArrayStringValues($file);
    }

    /**
     * @param mixed $file
     */
    public function getStrings($file)
    {
        return PhpParser::getStrings($file);
    }

    /**
     * @param mixed $file
     */
    public function getGlossaryWords($file)
    {
        return PhpParser::getGlossaryWords($file);
    }

    /**
     * @param $string
     *
     * @return array
     */
    public static function getWords($string)
    {
        preg_match_all('/[a-z]+/im', $string, $matchs);

        $words = [];
        foreach ($matchs[0] as $word) {
            if (S::isUpperCase($word)) {
                $words[] = strtolower($word);
            } else {
                $words = array_merge($words, explode('_', S::underscored($word)));
            }
        }

        return array_unique($words);
    }

    /**
     * @param mixed $string
     */
    public static function isStrictSourceCodeString($string)
    {
        if (preg_match('/\s+/m', $string)) {
            return false;
        }

        if (preg_match('/^[A-Z0-9_]+$/', $string)) {
            return true;
        }

        if ($string == ucfirst($string)) {
            return false;
        }

        return true;
    }
}
