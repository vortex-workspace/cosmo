<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\Enums\ConsoleStyleOption;
use Cosmo\Command\OutputStyle;

class RedBkg extends OutputStyle
{
    public function background(): ?ConsoleStyleColor
    {
        return ConsoleStyleColor::CustomRed;
    }

    public function name(): string
    {
        return 'red_bkg';
    }

    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::White;
    }

    public function options(): array
    {
        return [
            ConsoleStyleOption::Bold,
            ConsoleStyleOption::Conceal,
        ];
    }
}
