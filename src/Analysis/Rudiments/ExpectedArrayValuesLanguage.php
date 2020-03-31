<?php

namespace Glossarize\Analysis\Rudiments;

use Webmozart\Glob\Glob;
use Webmozart\PathUtil\Path;

trait ExpectedArrayValuesLanguage
{
    /**
     *
     */
    public function expectedArrayValuesLanguageIs($language)
    {
        $files = $this->getFiles();
        $parser = $this->getConfig()->getParser();
        $spellChecker = $this->getConfig()->getSpellChecker();

        foreach ($files as $file) {

            echo "=== {$relativePath} ===\n";
            $strings = $parser->getArrayStringValues($file);
            foreach ($strings as $string) {
                $line = $string[2];
                echo "$string[2]: $string[1]\n";
                $misspellings = $spellChecker->check($string[1], [$language]);
                foreach ($misspellings as $misspelling) {
                    $word = $misspelling->getWord();
                    $wordLine = $line + $misspelling->getLineNumber() - 1 ;
                    #$suggestions = $misspelling->getSuggestions();
                    #$suggestionsMessage = $suggestions ? '(suggestions: ' . implode(', ', $suggestions) . ')' : '';
                    #echo "$wordLine: $word $suggestionsMessage\n";
                    echo "$wordLine: $word\n";
                }
            }
        }
    }
}
