<?php

namespace Javanile\Glossar\Rudiments;

class ArrayValuesLanguageIs extends BaseRudiment
{
    /**
     * @param mixed $language
     */
    public function arrayValuesLanguageIs($language)
    {
        $files = $this->getFiles();
        $parser = $this->getConfig()->getParser();
        $spellChecker = $this->getConfig()->getSpellChecker();
        $reporter = $this->getConfig()->getReporter();
        //$output = $this->getConfig()->getSpellChecker();

        foreach ($files as $file) {
            $strings = $parser->getArrayStringValues($file['filename']);
            foreach ($strings as $stringData) {
                $string = $stringData[1];
                $stringLine = $stringData[2];
                $misspellings = $spellChecker->check($string, [$language]);
                foreach ($misspellings as $misspelling) {
                    $word = $misspelling->getWord();
                    $wordLine = $stringLine + $misspelling->getLineNumber() - 1;
                    $reporter->error("{$file['relative']}($wordLine): Misspelled word '{$word}' for language '{$language}' in '{$string}'".);
                }
            }
        }
    }
}
