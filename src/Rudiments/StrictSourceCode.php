<?php

namespace Javanile\Glossar\Rudiments;

use Glossarize\Analysis\Parsers\DefaultParser;

class ExpectedStrictSourceCode extends Rudiment
{
    /**
     *
     */
    public function expectedStrictSourceCode()
    {
        $files = $this->getFiles();
        $reporter = $this->getReporter();
        $parser = $this->getConfig()->getParser();
        $spellChecker = $this->getConfig()->getSpellChecker();

        foreach ($files as $file) {
            $strings = $parser->getStrings($file['filename']);
            foreach ($strings as $stringData) {
                $stringLine = $stringData[2];
                $string = $stringData[1];
                if (!DefaultParser::isStrictSourceCodeString($string)) {
                    echo "[FAIL] {$file['relative']}({$stringLine}): Strict source code violation with '{$string}' as string\n";
                }
            }
        }
    }
}
