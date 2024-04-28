<?php

namespace Cosmo\Commands;

use Cosmo\Option;
use Stellar\Cosmo\Command;
use Stellar\Cosmo\Command\Enums\CommandReturnStatus;
use Stellar\Navigation\File;

class PublishCosmo extends Command
{
    protected function handle(): CommandReturnStatus
    {
//        File::copy()
        return CommandReturnStatus::SUCCESS;
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
