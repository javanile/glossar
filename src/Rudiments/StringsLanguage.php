<?php

namespace Javanile\Glossar\Rudiments;

use Webmozart\Glob\Glob;
use Webmozart\PathUtil\Path;

trait StringsLanguage
{
    /**
     * @param mixed $language
     */
    public function expectedStringsLanguageIs($language)
    {
        $basePath = getcwd();
        $files = Glob::glob(Path::makeAbsolute('lang/array/**/*.php', $basePath));
        $parser = $this->getConfig()->getParser();
        $spellChecker = $this->getConfig()->getSpellChecker();

        foreach ($files as $file) {
            $relativePath = Path::makeRelative($file, $basePath);
            echo "=== {$relativePath} ===\n";
            $strings = $parser->getArrayStringValues($file);
            foreach ($strings as $string) {
                $line = $string[2];
                echo "$string[2]: $string[1]\n";
                $misspellings = $spellChecker->check($string[1], [$language]);
                foreach ($misspellings as $misspelling) {
                    $word = $misspelling->getWord();
                    $wordLine = $line + $misspelling->getLineNumber() - 1;
                    //$suggestions = $misspelling->getSuggestions();
                    //$suggestionsMessage = $suggestions ? '(suggestions: ' . implode(', ', $suggestions) . ')' : '';
                    //echo "$wordLine: $word $suggestionsMessage\n";
                    echo "$wordLine: $word\n";
                }
            }
        }
    }
}
