<?php

namespace Javanile\Glossar\Rudiments;

abstract class BaseRudiment
{
    /**
     *
     */
    protected $config;

    /**
     *
     */
    protected $source;

    /**
     * BaseRudiment constructor.
     *
     * @param $config
     * @param $source
     */
    public function __construct($config, $source)
    {
        $this->config = $config;
        $this->source = $source;
    }

    /**
     *
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     *
     */
    public function getFiles()
    {
        return $this->source->getFiles();
    }

    /**
     * @param $key
     *
     * @return
     */
    public function get($key)
    {
        return $this->source->get($key);
    }
}
