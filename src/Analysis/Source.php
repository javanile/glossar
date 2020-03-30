<?php

namespace Glossarize\Analysis;

class Source extends Pattern
{
    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($glob)
    {
        //$this->options = $options;
        pattern::__construct($glob);
    }

    /**
     *
     */
    public function run()
    {
        if (is_callable($this->options)) {
            call_user_func_array($this->options, []);
        } else {
            die("Check options are not callable");
        }
    }

    /**
     *
     */
    public function scan($glob)
    {
        return new Pattern($glob);
    }
}
