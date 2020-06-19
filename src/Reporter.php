<?php

namespace Javanile\Glossar;

class Reporter
{
    /**
     * Reporter constructor.
     */
    protected $output;

    /**
     *
     */
    protected $config;

    /**
     *
     */
    public function __construct($config)
    {
        $this->config = $config;
    }

    /**
     * @param $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * @param $message
     */
    public function error($message)
    {
        $this->output->error($message);
    }
}
