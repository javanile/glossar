<?php

namespace Javanile\Glossar\Rudiments;

use Webmozart\Glob\Glob;
use Webmozart\PathUtil\Path;

trait ArrayValuesLanguage
{
    /**
     *
     */
    public function expectedArrayValuesLanguageIs($language)
    {
        $files = $this->getFiles();
        $parser = $this->getConfig()->getParser();
        $spellChecker = $this->getConfig()->getSpellChecker();
        //$output = $this->getConfig()->getSpellChecker();
        $stopOnFailure = $this->get('stop-on-failure');

        $failure = false;
        foreach ($files as $file) {
            $strings = $parser->getArrayStringValues($file['filename']);
            foreach ($strings as $stringData) {
                $string = $stringData[1];
                $stringLine = $stringData[2];
                $misspellings = $spellChecker->check($string, [$language]);
                foreach ($misspellings as $misspelling) {
                    $word = $misspelling->getWord();
                    $wordLine = $stringLine + $misspelling->getLineNumber() - 1 ;
                    echo "[FAIL] {$file['relative']}($wordLine): Misspelled word '{$word}' for language '{$language}' in '{$string}.'\n";
                    if ($stopOnFailure) {
                        #$suggestions = $misspelling->getSuggestions();
                        #echo $suggestions ? '(SUGGESTION!) Replace with one of this: ' . implode(', ', $suggestions) . "\n" : '';
                        exit(1);
                    }
                    $failure = true;
                }
            }
        }

        return $this;
    }
}
