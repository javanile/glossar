<?php

namespace Glossarize\Analysis;

class Check
{
    /**
     *
     */
    protected $source;

    /**
     *
     */
    protected $options;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($source, $options)
    {
        $this->source = $source;
        $this->options = $options;
    }

    /**
     *
     */
    public function run()
    {
        if (is_callable($this->options)) {
            call_user_func_array($this->options, [$this->source]);
        } else {
            die("Check options are not callable");
        }
    }
}
