<?php

namespace Javanile\Glossar\Commands;

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
use DirectoryIterator;
use ZipArchive;

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
     * Verify that the application does not already exist.
     *
     * @param  string  $directory
     * @return void
     */
    protected function checkExtensions()
    {
        if (!extension_loaded('zip')) {
            throw new RuntimeException('The Zip PHP extension is not installed. Please install it and try again.');
        }
    }
}
