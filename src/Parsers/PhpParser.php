<?php

namespace Javanile\Glossar\Parsers;

class PhpParser
{
    /**
     * Sanitize string.
     *
     * @param mixed $string
     *
     * @return string
     */
    public static function sanitizeString($string)
    {
        return stripslashes(trim($string, '\'"'));
    }

    /**
     * @param mixed $file
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
     * @param mixed $file
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
     * @param mixed $file
     */
    public static function getGlossaryWords($file)
    {
        //var_dump($file);
        $code = file_get_contents($file);
        $tokens = token_get_all($code, TOKEN_PARSE);
        $words = [];

        $validWordsToken = [
            'T_STRING' => 'string',
            'T_CONSTANT_ENCAPSED_STRING' => 'string',
            'T_VARIABLE' => 'literal',
        ];

        foreach ($tokens as $token) {
            $tokenName = is_array($token) ? token_name($token[0]) : $token;
            if (isset($validWordsToken[$tokenName])) {
                $tokenWords = DefaultParser::getWords($token[1]);
                $span = count($tokenWords);
                foreach ($tokenWords as $word) {
                    $words[$word][] = [
                        'file' => $file,
                        'line' => $token[2],
                        'type' => $validWordsToken[$tokenName],
                        'name' => $tokenName,
                        'span' => $span,
                        'size' => strlen($token[1])
                    ];
                }
            } else {
                //var_dump($tokenName, $token);
            }
            //die();
        }

        return $words;
    }
}
