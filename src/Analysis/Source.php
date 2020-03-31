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
    public function __construct($parser, $pattern)
    {
        $this->vars = [];
        $this->parser = $parser;
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
    protected function getParser()
    {
        return $this->parser;
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
    public function expectedArrayValuesLanguageIs()
    {
        $basePath = getcwd();
        $files = Glob::glob(Path::makeAbsolute('lang/array/**/*.php', $basePath));
        $parser = $this->getParser();

        foreach ($files as $file) {
            $relativePath = Path::makeRelative($file, $basePath);
            echo "=== ${$relativePath} ===\n";
            $strings = $parser->getArrayStringValues($file);
            foreach ($strings as $string) {
                echo "$string[2]: $string[1]\n";
            }
        }
    }

    /**
     *
     */
    public function strictSourceCode()
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
        return new Source($this->getParser(), $pattern);
    }
}
