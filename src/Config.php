<?php

namespace Javanile\Glossar;

use Glossarize\Analysis\Parsers\DefaultParser;
use PhpSpellcheck\Spellchecker\Aspell;

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
     * @param mixed $cwd
     */
    public function __construct($cwd)
    {
        $this->cwd = $cwd;

        $this->config = [
            'init'  => [],
            'check' => [],
        ];

        $this->parser = new DefaultParser();
        $this->source = new Source($this, '**/*.php', $this->cwd);
        $this->spellChecker = null;
    }

    /**
     * @param $name
     * @param $arguments
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        if ($name === 'default') {
            return call_user_func_array([$this, 'customDefault'], $arguments);
        } else {
            die("Glossarize: not support for '{$name}'");
        }
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
     * @param mixed $initOptions
     */
    public function init($initOptions)
    {
        $this->config['init'][] = $initOptions;
    }

    /**
     * @param mixed $checkName
     * @param mixed $checkOptions
     */
    public function check($checkName, $checkOptions)
    {
        if (isset($this->config['check'][$checkName])) {
            echo "[ERROR] Check '{$checkName}' already defined.\n";
            debug_print_backtrace();
            exit(1);
        }

        $this->config['check'][$checkName] = new Check($this->source, $checkOptions);
    }

    /**
     * @param mixed $defaultOptions
     */
    protected function customDefault($defaultOptions)
    {
        //$this->config['check'][$checkName] = new Check($this->source, $checkOptions);
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
                die('Init options are not callable');
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
