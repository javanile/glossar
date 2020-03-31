<?php

namespace Glossarize\Analysis;

use PhpSpellcheck\Spellchecker\Aspell;

class Config
{
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
    public function __construct()
    {
        $this->config = [
            'init' => [],
            'check' => [],
        ];

        $this->parser = new Parser;
        $this->source = new Source($this, '*');
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
