<?php

namespace Cosmo\Console\Inputs;

use Cosmo\Console\Concerns\TypedValue;
use Cosmo\Console\Prompt;

class PasswordPrompt extends Prompt
{
    use TypedValue;

    /**
     * Create a new PasswordPrompt instance.
     */
    public function __construct(
        public string $label,
        public string $placeholder = '',
        public bool|string $required = false,
        public mixed $validate = null,
        public string $hint = '',
    ) {
        $this->trackTypedValue();
    }

    /**
     * Get a masked version of the entered value.
     */
    public function masked(): string
    {
        return str_repeat('•', mb_strlen($this->value()));
    }

    /**
     * Get the masked value with a virtual cursor.
     */
    public function maskedWithCursor(int $maxWidth): string
    {
        if ($this->value() === '') {
            return $this->dim($this->addCursor($this->placeholder, 0, $maxWidth));
        }

        return $this->addCursor($this->masked(), $this->cursorPosition, $maxWidth);
    }
}
