<?php

namespace Glossarize\Analysis;

class Config
{
    /**
     *
     */
    protected $source;

    /**
     *
     */
    protected $config;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($source)
    {
        $this->config = [
            'init' => [],
            'check' => [],
        ];
        $this->source = $source;
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
    }

    /**
     *
     */
    public function getChecks()
    {
        return $this->config['check'];
    }
}
