<?php

namespace Cosmo\Themes\Default;


class PausePromptRenderer extends Renderer
{
    use Concerns\DrawsBoxes;

    /**
     * Render the pause prompt.
     */
    public function __invoke(PausePrompt $prompt): string
    {
        match ($prompt->state) {
            'submit' => collect(explode(PHP_EOL, $prompt->message))
                ->each(fn ($line) => $this->line($this->gray(" {$line}"))),
            default => collect(explode(PHP_EOL, $prompt->message))
                ->each(fn ($line) => $this->line($this->green(" {$line}")))
        };

        return $this;
    }
}
