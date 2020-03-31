<?php

namespace Glossarize\Analysis;

use Webmozart\Glob\Glob;
use Webmozart\PathUtil\Path;

class Source
{
    /**
     *
     */
    protected $vars;

    /**
     *
     */
    protected $config;

    /**
     *
     */
    protected $pattern;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($config, $pattern)
    {
        $this->vars = [];
        $this->config = $config;
        $this->pattern = $pattern;
    }

    /**
     * @param $var
     */
    public function get($var)
    {
        return $this->vars[$var];
    }

    /**
     * @param $var
     */
    public function set($var, $value)
    {
        $this->vars[$var] = $value;
    }

    /**
     *
     */
    protected function getConfig()
    {
        return $this->config;
    }

    /**
     *
     */
    public function stringsLanguageIs()
    {

    }

    /**
     *
     */
    public function expectedArrayValuesLanguageIs($language)
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
                    $wordLine = $line + $misspelling->getLineNumber() - 1 ;
                    #$suggestions = $misspelling->getSuggestions();
                    #$suggestionsMessage = $suggestions ? '(suggestions: ' . implode(', ', $suggestions) . ')' : '';
                    #echo "$wordLine: $word $suggestionsMessage\n";
                    echo "$wordLine: $word\n";
                }
            }
        }
    }

    /**
     *
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
                    $wordLine = $line + $misspelling->getLineNumber() - 1 ;
                    #$suggestions = $misspelling->getSuggestions();
                    #$suggestionsMessage = $suggestions ? '(suggestions: ' . implode(', ', $suggestions) . ')' : '';
                    #echo "$wordLine: $word $suggestionsMessage\n";
                    echo "$wordLine: $word\n";
                }
            }
        }
    }

    /**
     *
     */
    public function expectedStrictSourceCode()
    {

    }

    /**
     *
     */
    public function strictScope()
    {

    }

    /**
     *
     */
    public function scan($pattern)
    {
        return new Source($this->getConfig(), $pattern);
    }
}
