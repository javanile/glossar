<?php

namespace Javanile\Glossar\Commands;

use RuntimeException;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

abstract class BaseCommand extends Command
{
    /**
     *
     */
    protected function credits(OutputInterface $output)
    {
        $output->writeln("Glossar 0.1.0 by Francesco Bianco and contributors.\n");
    }

    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this->addOption('--stop-on-failure', null, InputOption::VALUE_NONE, 'Stop execution if check fail');
    }

    /**
     * Verify that the application does not already exist.
     *
     * @param string $directory
     *
     * @return void
     */
    protected function checkExtensions()
    {
        if (!extension_loaded('zip')) {
            throw new RuntimeException('The Zip PHP extension is not installed. Please install it and try again.');
        }
    }
}
