<?php

namespace Cosmo\Commands;

use Cosmo\Command;
use Cosmo\Option;
use Cosmo\Command\Enums\CommandResponse;

class PublishCosmo extends Command
{
    protected function handle(): CommandResponse
    {
//        File::copy()
        return CommandResponse::SUCCESS;
    }

    protected function configure(): void
    {
        $this->setHelp('Publish Cosmo connection file.');
    }

    protected function name(): string
    {
        return 'cosmo:publish';
    }

    protected function options(): array
    {
        return [
            Option::make('force', 'f', 'Force publish file, if exists overwrite.'),
        ];
    }
}
