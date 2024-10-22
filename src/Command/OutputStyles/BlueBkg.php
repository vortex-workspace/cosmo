<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\OutputStyle;

class BlueBkg extends OutputStyle
{
    public function background(): ?ConsoleStyleColor
    {
        return ConsoleStyleColor::CustomBlue;
    }

    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::White;
    }

    public function name(): string
    {
        return 'blue_bkg';
    }
}
