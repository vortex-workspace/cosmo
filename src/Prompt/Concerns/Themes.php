<?php

namespace Cosmo\Prompt\Concerns;

use InvalidArgumentException;
use Cosmo\ConfirmPrompt;
use Cosmo\MultiSearchPrompt;
use Cosmo\MultiSelectPrompt;
use Cosmo\Note;
use Cosmo\PasswordPrompt;
use Cosmo\PausePrompt;
use Cosmo\Progress;
use Cosmo\SearchPrompt;
use Cosmo\SelectPrompt;
use Cosmo\Spinner;
use Cosmo\SuggestPrompt;
use Cosmo\Table;
use Cosmo\TextareaPrompt;
use Cosmo\TextPrompt;
use Cosmo\Themes\Default\ConfirmPromptRenderer;
use Cosmo\Themes\Default\MultiSearchPromptRenderer;
use Cosmo\Themes\Default\MultiSelectPromptRenderer;
use Cosmo\Themes\Default\NoteRenderer;
use Cosmo\Themes\Default\PasswordPromptRenderer;
use Cosmo\Themes\Default\PausePromptRenderer;
use Cosmo\Themes\Default\ProgressRenderer;
use Cosmo\Themes\Default\SearchPromptRenderer;
use Cosmo\Themes\Default\SelectPromptRenderer;
use Cosmo\Themes\Default\SpinnerRenderer;
use Cosmo\Themes\Default\SuggestPromptRenderer;
use Cosmo\Themes\Default\TableRenderer;
use Cosmo\Themes\Default\TextareaPromptRenderer;
use Cosmo\Themes\Default\TextPromptRenderer;

trait Themes
{
    /**
     * The name of the active theme.
     */
    protected static string $theme = 'default';

    /**
     * The available themes.
     *
     * @var array<string, array<class-string<\Cosmo\Prompt>, class-string<object&callable>>>
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
     * @param  array<class-string<\Cosmo\Prompt>, class-string<object&callable>>  $renderers
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
