<?php

namespace PHP\TreeBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GreetCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('demo:greet:php')
            ->setDescription('Greet someone')
            ->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you wont to greet?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task yell in uppercase letters'
            )
        ;
    }

    protected function execute(InputInterface $inputInterface, OutputInterface $outputInterface)
    {
        $name = $inputInterface->getArgument('name');
        if ($name) {
            $text = 'Hello bla-bla-bla ' . $name;
        } else {
            $text = 'Hello GREEN';
        }

        if ($inputInterface->getOption('yell')) {
            $text = strtoupper($text);
        }

        $outputInterface->writeln('<info>' . $text . '</info>');
    }
}
