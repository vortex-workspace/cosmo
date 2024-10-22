<?php

namespace Cosmo\Command\OutputStyles;

use Cosmo\Command\Enums\ConsoleStyleColor;
use Cosmo\Command\OutputStyle;

class BrightBlueBkg extends OutputStyle
{
    public function background(): ?ConsoleStyleColor
    {
        return ConsoleStyleColor::BrightBlue;
    }

    public function foreground(): ConsoleStyleColor
    {
        return ConsoleStyleColor::White;
    }

    public function name(): string
    {
        return 'bright_blue_bkg';
    }
}
