<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\Enums\ConsoleStyleOption;
use Cosmo\Command\OutputStyle;

class GreenBkg extends OutputStyle
{
    public function background(): ?ConsoleStyleColor
    {
        return ConsoleStyleColor::Green;
    }

    public function name(): string
    {
        return 'green_bkg';
    }

    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::White;
    }

    public function options(): array
    {
        return [
            ConsoleStyleOption::Bold,
        ];
    }
}
