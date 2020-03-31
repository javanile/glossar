<?php

namespace Glossarize\Analysis;

class Source
{
    /**
     *
     */
    protected $vars;

    /**
     *
     */
    protected $glob;

    /**
     * Config constructor.
     *
     * @param $config
     */
    public function __construct($glob)
    {
        $this->glob = $glob;
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
    public function stringsLanguageIs()
    {

    }

    /**
     *
     */
    public function expectedArrayValuesLanguageIs()
    {

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
    public function scan($glob)
    {
        return new Source($glob);
    }
}
