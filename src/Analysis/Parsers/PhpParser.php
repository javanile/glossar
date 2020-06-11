<?php

namespace Glossarize\Analysis\Parsers;

use Stringy\StaticStringy as S;

class PhpParser
{
    /**
     *
     */
    public static function sanitizeString($string)
    {
        return stripslashes(trim($string, '\'"'));
    }

    /**
     *
     */
    public static function getArrayStringValues($file)
    {
        $code = file_get_contents($file);
        $tokens = token_get_all($code, TOKEN_PARSE);
        $strings = [];

        $isValue = false;
        foreach ($tokens as $token) {
            $tokenName = is_array($token) ? token_name($token[0]) : $token;
            if (!$isValue && $tokenName === 'T_DOUBLE_ARROW') {
                $isValue = true;
            } elseif ($isValue && $tokenName === 'T_CONSTANT_ENCAPSED_STRING') {
                $token[1] = self::sanitizeString($token[1]);
                $strings[] = $token;
                $isValue = false;
            } elseif ($isValue && $tokenName !== 'T_WHITESPACE') {
                $isValue = false;
            }
        }

        return $strings;
    }

    /**
     *
     */
    public static function getStrings($file)
    {
        $code = file_get_contents($file);
        $tokens = token_get_all($code, TOKEN_PARSE);
        $strings = [];

        foreach ($tokens as $token) {
            $tokenName = is_array($token) ? token_name($token[0]) : $token;
            if ($tokenName === 'T_CONSTANT_ENCAPSED_STRING') {
                $token[1] = self::sanitizeString($token[1]);
                $strings[] = $token;
                $isValue = false;
            }
        }

        return $strings;
    }

    /**
     *
     */
    public static function getGlossaryWords($file)
    {
        //var_dump($file);
        $code = file_get_contents($file);
        $tokens = token_get_all($code, TOKEN_PARSE);
        $words = [];

        $validWordsToken = [
            'T_STRING',
            'T_CONSTANT_ENCAPSED_STRING',
            'T_VARIABLE'
        ];

        foreach ($tokens as $token) {
            $tokenName = is_array($token) ? token_name($token[0]) : $token;
            if (in_array($tokenName, $validWordsToken)) {
                $tokenWords = DefaultParser::getWords($token[1]);
                foreach ($tokenWords as $word) {
                    $words[$word][] = [$file, $token[2]];
                }
            } else {
                //var_dump($tokenName, $token);
            }
            //die();
        }

        return $words;
    }
}
