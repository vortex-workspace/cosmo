<?php

namespace Cosmo\Commands;

use Cosmo\Command;
use Cosmo\Command\Enums\CommandResponse;
use Psy\Configuration;
use Psy\Shell;

class CosmoShell extends Command
{
    protected function handle(): CommandResponse
    {
        $config = new Configuration([
            'colorMode' => Configuration::COLOR_MODE_AUTO,
            'errorLoggingLevel' => E_ALL,
            'forceArrayIndexes' => true,
            'historySize' => 10,
            'prompt' => '>>>',
        ]);

        $shell = new Shell($config);
        $shell->run();
        return CommandResponse::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setHelp('Start an interactive php line command, based on package "psy/psysh".');
    }

    protected function name(): string
    {
        return 'cosmo:shell';
    }

    protected function options(): array
    {
        return [];
    }
}
