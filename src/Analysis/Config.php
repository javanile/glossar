<?php

namespace Glossarize\Analysis;

class Config
{
    /**
     *
     */
    protected $checks;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct()
    {

    }

    /**
     *
     */
    public function check($checkName, $checkOptions)
    {
        $this->checks[$checkName] = $checkOptions;
    }
}
