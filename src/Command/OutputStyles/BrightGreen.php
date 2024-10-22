<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\Enums\ConsoleStyleOption;
use Cosmo\Command\OutputStyle;

class BrightGreen extends OutputStyle
{
    public function name(): string
    {
        return 'bright_green';
    }

    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::BrightGreen;
    }

    public function options(): array
    {
        return [
            ConsoleStyleOption::Bold,
        ];
    }
}
