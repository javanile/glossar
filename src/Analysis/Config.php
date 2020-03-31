<?php

namespace Glossarize\Analysis;

use PhpSpellcheck\Spellchecker\Aspell;
use Glossarize\Analysis\Parsers\DefaultParser;

class Config
{
    /**
     *
     */
    protected $cwd;

    /**
     *
     */
    protected $config;

    /**
     *
     */
    protected $parser;

    /**
     *
     */
    protected $source;

    /**
     *
     */
    protected $spellChecker;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($cwd)
    {
        $this->cwd = $cwd;

        $this->config = [
            'init' => [],
            'check' => [],
        ];

        $this->parser = new DefaultParser;
        $this->source = new Source($this, '**/*.php', $this->cwd);
        $this->spellChecker = null;
    }

    /**
     *
     */
    public function getCwd()
    {
        return $this->cwd;
    }

    /**
     *
     */
    public function getParser()
    {
        return $this->parser;
    }

    /**
     *
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     *
     */
    public function getSpellChecker()
    {
        return $this->spellChecker;
    }

    /**
     *
     */
    public function init($initOptions)
    {
        $this->config['init'][] = $initOptions;
    }

    /**
     *
     */
    public function check($checkName, $checkOptions)
    {
        $this->config['check'][$checkName] = new Check($this->source, $checkOptions);
    }

    /**
     *
     */
    public function bootstrap()
    {
        foreach ($this->config['init'] as $init) {
            if (is_callable($init)) {
                call_user_func_array($init, [$this->source]);
            } else {
                die("Init options are not callable");
            }
        }

        $this->spellChecker = Aspell::create();
    }

    /**
     *
     */
    public function getChecks()
    {
        return $this->config['check'];
    }
}
