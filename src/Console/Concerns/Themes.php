<?php

namespace Cosmo\Console\Concerns;

use Cosmo\Console\Inputs\ConfirmPrompt;
use Cosmo\Console\Inputs\MultiSearchPrompt;
use Cosmo\Console\Inputs\MultiSelectPrompt;
use Cosmo\Console\Inputs\Note;
use Cosmo\Console\Inputs\PasswordPrompt;
use Cosmo\Console\Inputs\PausePrompt;
use Cosmo\Console\Inputs\Progress;
use Cosmo\Console\Inputs\SearchPrompt;
use Cosmo\Console\Inputs\SelectPrompt;
use Cosmo\Console\Inputs\Spinner;
use Cosmo\Console\Inputs\SuggestPrompt;
use Cosmo\Console\Inputs\Table;
use Cosmo\Console\Inputs\TextareaPrompt;
use Cosmo\Console\Inputs\TextPrompt;
use Cosmo\Console\Themes\Default\ConfirmPromptRenderer;
use Cosmo\Console\Themes\Default\MultiSearchPromptRenderer;
use Cosmo\Console\Themes\Default\MultiSelectPromptRenderer;
use Cosmo\Console\Themes\Default\NoteRenderer;
use Cosmo\Console\Themes\Default\PasswordPromptRenderer;
use Cosmo\Console\Themes\Default\PausePromptRenderer;
use Cosmo\Console\Themes\Default\ProgressRenderer;
use Cosmo\Console\Themes\Default\SearchPromptRenderer;
use Cosmo\Console\Themes\Default\SelectPromptRenderer;
use Cosmo\Console\Themes\Default\SpinnerRenderer;
use Cosmo\Console\Themes\Default\SuggestPromptRenderer;
use Cosmo\Console\Themes\Default\TableRenderer;
use Cosmo\Console\Themes\Default\TextareaPromptRenderer;
use Cosmo\Console\Themes\Default\TextPromptRenderer;
use InvalidArgumentException;

trait Themes
{
    /**
     * The name of the active theme.
     */
    protected static string $theme = 'default';

    /**
     * The available themes.
     *
     * @var array<string, array<class-string<\Cosmo\Console\Prompt>, class-string<object&callable>>>
     */
    protected static array $themes = [
        'default' => [
            TextPrompt::class => TextPromptRenderer::class,
            TextareaPrompt::class => TextareaPromptRenderer::class,
            PasswordPrompt::class => PasswordPromptRenderer::class,
            SelectPrompt::class => SelectPromptRenderer::class,
            MultiSelectPrompt::class => MultiSelectPromptRenderer::class,
            ConfirmPrompt::class => ConfirmPromptRenderer::class,
            PausePrompt::class => PausePromptRenderer::class,
            SearchPrompt::class => SearchPromptRenderer::class,
            MultiSearchPrompt::class => MultiSearchPromptRenderer::class,
            SuggestPrompt::class => SuggestPromptRenderer::class,
            Spinner::class => SpinnerRenderer::class,
            Note::class => NoteRenderer::class,
            Table::class => TableRenderer::class,
            Progress::class => ProgressRenderer::class,
        ],
    ];

    /**
     * Get or set the active theme.
     *
     * @throws \InvalidArgumentException
     */
    public static function theme(?string $name = null): string
    {
        if ($name === null) {
            return static::$theme;
        }

        if (! isset(static::$themes[$name])) {
            throw new InvalidArgumentException("Prompt theme [{$name}] not found.");
        }

        return static::$theme = $name;
    }

    /**
     * Add a new theme.
     *
     * @param  array<class-string<\Cosmo\Console\Prompt>, class-string<object&callable>>  $renderers
     */
    public static function addTheme(string $name, array $renderers): void
    {
        if ($name === 'default') {
            throw new InvalidArgumentException('The default theme cannot be overridden.');
        }

        static::$themes[$name] = $renderers;
    }

    /**
     * Get the renderer for the current prompt.
     */
    protected function getRenderer(): callable
    {
        $class = get_class($this);

        return new (static::$themes[static::$theme][$class] ?? static::$themes['default'][$class])($this);
    }

    /**
     * Render the prompt using the active theme.
     */
    protected function renderTheme(): string
    {
        $renderer = $this->getRenderer();

        return $renderer($this);
    }
}
