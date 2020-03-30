<?php

namespace Glossarize\Console;

use GuzzleHttp\Client;
use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;
use ZipArchive;

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
}
