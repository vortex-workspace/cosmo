<?php

namespace Cosmo\Console\Themes\Default;

use Cosmo\Console\Inputs\TextareaPrompt;
use Cosmo\Console\Themes\Contracts\Scrolling;
use Stellar\Facades\Collection;

class TextareaPromptRenderer extends Renderer implements Scrolling
{
    use \Cosmo\Console\Themes\Default\Concerns\DrawsBoxes;
    use \Cosmo\Console\Themes\Default\Concerns\DrawsScrollbars;

    /**
     * Render the textarea prompt.
     */
    public function __invoke(TextareaPrompt $prompt): string
    {
        $prompt->width = $prompt->terminal()->cols() - 8;

        return match ($prompt->state) {
            'submit' => $this
                ->box(
                    $this->dim($this->truncate($prompt->label, $prompt->width)),
                    Collection::from($prompt->lines())->implode(PHP_EOL),
                ),

            'cancel' => $this
                ->box(
                    $this->truncate($prompt->label, $prompt->width),
                    Collection::from($prompt->lines())->map(fn ($line) => $this->strikethrough($this->dim($line)))->implode(PHP_EOL),
                    color: 'red',
                )
                ->error($prompt->cancelMessage),

            'error' => $this
                ->box(
                    $this->truncate($prompt->label, $prompt->width),
                    $this->renderText($prompt),
                    color: 'yellow',
                    info: 'Ctrl+D to submit'
                )
                ->warning($this->truncate($prompt->error, $prompt->terminal()->cols() - 5)),

            default => $this
                ->box(
                    $this->cyan($this->truncate($prompt->label, $prompt->width)),
                    $this->renderText($prompt),
                    info: 'Ctrl+D to submit'
                )
                ->when(
                    $prompt->hint,
                    fn () => $this->hint($prompt->hint),
                    fn () => $this->newLine() // Space for errors
                )
        };
    }

    /**
     * Render the text in the prompt.
     */
    protected function renderText(TextareaPrompt $prompt): string
    {
        $visible = Collection::from($prompt->visible());

        while ($visible->count() < $prompt->scroll) {
            $visible->push('');
        }

        $longest = $this->longest($prompt->lines()) + 2;

        return $this->scrollbar(
            $visible,
            $prompt->firstVisible,
            $prompt->scroll,
            count($prompt->lines()),
            min($longest, $prompt->width + 2),
        )->implode(PHP_EOL);
    }

    /**
     * The number of lines to reserve outside of the scrollable area.
     */
    public function reservedLines(): int
    {
        return 5;
    }
}
