<?php

namespace Cosmo\Argument\Enums;

use Symfony\Component\Console\Input\InputArgument;

enum ArgumentMode: int
{
    case Required = InputArgument::REQUIRED;
    case Optional = InputArgument::OPTIONAL;
    case IsArray = InputArgument::IS_ARRAY;
}
