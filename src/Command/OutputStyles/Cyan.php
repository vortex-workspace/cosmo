<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\Enums\ConsoleStyleOption;
use Cosmo\Command\OutputStyle;

class Cyan extends OutputStyle
{
    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::Cyan;
    }

    public function name(): string
    {
        return 'cyan';
    }

    public function options(): array
    {
        return [
            ConsoleStyleOption::Bold,
        ];
    }
}
