<?php

namespace Glossarize\Console\Commands;

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

class CheckCommand extends BaseCommand
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        $this
            ->setName('check')
            ->setDescription('Run one or all checks')
            ->addArgument('check-name', InputArgument::OPTIONAL);
    }

    /**
     * Execute the command.
     *
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->checkExtensions();

        $selectedCheckName = $input->getArgument('check-name');

        $checks = $this->getApplication()->getConfig()->getChecks();

        foreach ($checks as $checkName => $check) {
            $check->run();
        }

        $output->writeln('<info>Registry lookup...</info>');

        $output->writeln('<comment>Brick ready! Build something amazing.</comment>');

        return 0;
    }
}
