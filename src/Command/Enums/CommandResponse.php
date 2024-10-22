<?php

namespace Cosmo\Command\Enums;

enum CommandResponse: int
{
    case SUCCESS = 0;
    case FAILED = 1;
    case INVALID = 2;
}
