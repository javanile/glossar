<?php

namespace Javanile\Glossar\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


class CheckCommand extends BaseCommand
{
    /**
     * Configure the command options.
     *
     * @return void
     */
    protected function configure()
    {
        parent::configure();

        $this
            ->setName('check')
            ->setDescription('Run one or all checks')
            //->addArgument('check-name', InputArgument::OPTIONAL)
            ->addOption('--filter', null, InputOption::VALUE_REQUIRED, 'Stop execution if check fail')
            ->addOption('--stop-on-failure', null, InputOption::VALUE_NONE, 'Stop execution if check fail');
    }

    /**
     * Execute the command.
     *
     *
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->credits($output);

        //$selectedCheckName = $input->getArgument('check-name');

        $config = $this->getApplication()->getConfig();
        $config->bootstrap($output);

        foreach ($config->getChecks() as $checkName => $check) {
            $output->writeln("<info>===> {$checkName}</info>");
            $check->execute([
                'stop-on-failure' => $input->getOption('stop-on-failure'),
            ]);
        }

        return 0;
    }
}
