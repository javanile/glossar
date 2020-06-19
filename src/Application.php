<?php

namespace Javanile\Glossar;

use Symfony\Component\Console\Application as ConsoleApplication;

class Application extends ConsoleApplication
{
    /**
     * Application configuration.
     *
     * @param Config
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
     * Get application config.
     */
    public function getConfig()
    {
        return $this->config;
    }
}
