<?php

namespace Cosmo\Console;

use Stellar\Facades\Collection;

class Key
{
    const string UP = "\e[A";

    const string SHIFT_UP = "\e[1;2A";

    const string DOWN = "\e[B";

    const string SHIFT_DOWN = "\e[1;2B";

    const string RIGHT = "\e[C";

    const string LEFT = "\e[D";

    const string UP_ARROW = "\eOA";

    const string DOWN_ARROW = "\eOB";

    const string RIGHT_ARROW = "\eOC";

    const string LEFT_ARROW = "\eOD";

    const string ESCAPE = "\e";

    const string DELETE = "\e[3~";

    const string BACKSPACE = "\177";

    const string ENTER = "\n";

    const string SPACE = ' ';

    const string TAB = "\t";

    const string SHIFT_TAB = "\e[Z";

    const array HOME = ["\e[1~", "\eOH", "\e[H", "\e[7~"];

    const array END = ["\e[4~", "\eOF", "\e[F", "\e[8~"];

    /**
     * Cancel/SIGINT
     */
    const string CTRL_C = "\x03";

    /**
     * Previous/Up
     */
    const string CTRL_P = "\x10";

    /**
     * Next/Down
     */
    const string CTRL_N = "\x0E";

    /**
     * Forward/Right
     */
    const string CTRL_F = "\x06";

    /**
     * Back/Left
     */
    const string CTRL_B = "\x02";

    /**
     * Backspace
     */
    const string CTRL_H = "\x08";

    /**
     * Home
     */
    const string CTRL_A = "\x01";

    /**
     * EOF
     */
    const string CTRL_D = "\x04";

    /**
     * End
     */
    const string CTRL_E = "\x05";

    /**
     * Negative affirmation
     */
    const string CTRL_U = "\x15";

    /**
     * Checks for the constant values for the given match and returns the match
     *
     * @param  array<string|array<string>>  $keys
     */
    public static function oneOf(array $keys, string $match): ?string
    {
        return Collection::from($keys)->flatten()->contains($match) ? $match : null;
    }
}
