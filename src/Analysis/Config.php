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
    protected $checks;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($source)
    {
        $this->source = $source;
    }

    /**
     *
     */
    public function check($checkName, $checkOptions)
    {
        $this->checks[$checkName] = new Check($this->source, $checkOptions);
    }

    /**
     *
     */
    public function getChecks()
    {
        return $this->checks;
    }
}
