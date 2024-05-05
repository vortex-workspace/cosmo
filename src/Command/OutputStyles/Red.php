<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\Enums\ConsoleStyleOption;
use Cosmo\Command\OutputStyle;

class Red extends OutputStyle
{
    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::Red;
    }

    public function options(): array
    {
        return [
            ConsoleStyleOption::Bold,
        ];
    }

    public function name(): string
    {
        return 'red';
    }
}
