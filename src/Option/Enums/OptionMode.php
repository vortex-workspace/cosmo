<?php

namespace Cosmo\Option\Enums;

use Symfony\Component\Console\Input\InputOption;

enum OptionMode: int
{
    case None = 1;
    case Required = 2;
    case Optional = 4;
    case IsArray = 8;
    case Negatable = 16;
}
