<?php

namespace Cosmo\Console\Themes\Default;


use Cosmo\Console\Inputs\PausePrompt;

class PausePromptRenderer extends Renderer
{
    use \Cosmo\Console\Themes\Default\Concerns\DrawsBoxes;

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
