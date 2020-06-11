<?php

namespace Javanile\Glossar;

class Application extends \Symfony\Component\Console\Application
{
    /**
     * Application configuration.
     *
     * @param $config
     */
    protected $config;

    /**
     * Application constructor.
     *
     * @param $config
     */
    public function __construct($config)
    {
        parent::__construct();

        $this->config = $config;
    }

    /**
     *
     */
    public function getConfig()
    {
        return $this->config;
    }
}
