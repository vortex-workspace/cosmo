<?php

namespace Cosmo\Commands;

use Cosmo\Command;
use Cosmo\Command\Enums\CommandResponse;

class CosmoShell extends Command
{
    protected function handle(): CommandResponse
    {

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
