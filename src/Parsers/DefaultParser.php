<?php

namespace Javanile\Glossar\Parsers;

use Javanile\Glossar\Parsers\PhpParser;
use Stringy\StaticStringy as S;

class DefaultParser
{
    /**
     * Get all strings placed as values of arrays defined into file.
     *
     * @param mixed $file
     *
     * @return array
     */
    public function getArrayStringValues($file)
    {
        return PhpParser::getArrayStringValues($file);
    }

    /**
     * Get all strings used in the file.
     *
     * @param mixed $file
     *
     * @return array
     */
    public function getStrings($file)
    {
        return PhpParser::getStrings($file);
    }

    /**
     * Get all words useful for glossary.
     *
     * @param mixed $file
     *
     * @return array
     */
    public function getGlossaryWords($file)
    {
        return PhpParser::getGlossaryWords($file);
    }

    /**
     * Get all words in the string.
     *
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
     * Is a string contain source code without text message strings.
     *
     * @param mixed $string
     *
     * @return bool
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
