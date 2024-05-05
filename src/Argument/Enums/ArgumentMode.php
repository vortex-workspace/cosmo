<?php

namespace Cosmo\Argument\Enums;

use Symfony\Component\Console\Input\InputArgument;

enum ArgumentMode: int
{
    case Required = 1;
    case Optional = 2;
    case IsArray = 4;
}
