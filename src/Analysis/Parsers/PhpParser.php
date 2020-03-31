<?php

namespace Glossarize\Analysis\Parsers;

class PhpParser
{
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
                $strings[] = $token;
                $isValue = false;
            } elseif ($isValue && $tokenName !== 'T_WHITESPACE') {
                $isValue = false;
            }
        }

        return $strings;
    }
}
