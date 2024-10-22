<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\Enums\ConsoleStyleOption;
use Cosmo\Command\OutputStyle;

class YellowBkg extends OutputStyle
{
    public function background(): ?ConsoleStyleColor
    {
        return ConsoleStyleColor::Yellow;
    }

    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::White;
    }

    public function name(): string
    {
        return 'yellow_bkg';
    }

    public function options(): array
    {
        return [
            ConsoleStyleOption::Bold
        ];
    }
}
