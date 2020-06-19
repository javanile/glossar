<?php

namespace Javanile\Glossar\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class GlossaryAnalysisCommand extends BaseCommand
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
            ->setName('default')
            ->setDescription('Run glossary analysis as standard PHP package');
            #->addOption('--stop-on-failure', null, InputOption::VALUE_NONE, 'Stop execution if check fail');
    }

    /**
     * Execute the command.
     *
     * @param InputInterface   $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->credits($output);

        $config = $this->getApplication()->getConfig();

        $config->bootstrap();

        $source = $config->getSource();

        $source->set('stop-on-failure', $input->getOption('stop-on-failure'));

        $source->scan('src')->glossaryAnalysis();

        return 0;
    }
}
