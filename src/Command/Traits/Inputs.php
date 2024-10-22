<?php

namespace Cosmo\Command\Traits;

use Closure;
use Cosmo\Console\Inputs\ConfirmPrompt;
use Cosmo\Console\Inputs\FormBuilder;
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
use Stellar\Facades\Collection;

trait Inputs
{
    protected function text(
        string      $label,
        string      $placeholder = '',
        string      $default = '',
        bool|string $required = false,
        mixed       $validate = null,
        string      $hint = ''
    ): string
    {
        return (new TextPrompt(...func_get_args()))->prompt();
    }

    protected function textarea(
        string      $label,
        string      $placeholder = '',
        string      $default = '',
        bool|string $required = false,
        ?Closure    $validate = null,
        string      $hint = '',
        int         $rows = 5
    ): string
    {
        return (new TextareaPrompt($label, $placeholder, $default, $required, $validate, $hint, $rows))->prompt();
    }

    protected function password(
        string      $label,
        string      $placeholder = '',
        bool|string $required = false,
        mixed       $validate = null,
        string      $hint = ''
    ): string
    {
        return (new PasswordPrompt(...func_get_args()))->prompt();
    }

    protected function select(
        string           $label,
        array|Collection $options,
        int|string|null  $default = null,
        int              $scroll = 5,
        mixed            $validate = null,
        string           $hint = '',
        bool|string      $required = true
    ): int|string
    {
        return (new SelectPrompt(...func_get_args()))->prompt();
    }

    protected function multiselect(
        string           $label,
        array|Collection $options,
        array|Collection $default = [],
        int              $scroll = 5,
        bool|string      $required = false,
        mixed            $validate = null,
        string           $hint = 'Use the space bar to select options.'
    ): array
    {
        return (new MultiSelectPrompt(...func_get_args()))->prompt();
    }

    protected function confirm(
        string      $label,
        bool        $default = true,
        string      $yes = 'Yes',
        string      $no = 'No',
        bool|string $required = false,
        mixed       $validate = null,
        string      $hint = ''
    ): bool
    {
        return (new ConfirmPrompt(...func_get_args()))->prompt();
    }

    protected function pause(string $message = 'Press enter to continue...'): bool
    {
        return (new PausePrompt(...func_get_args()))->prompt();
    }

    protected function suggest(
        string                   $label,
        array|Collection|Closure $options, string $placeholder = '', string $default = '', int $scroll = 5, bool|string $required = false, mixed $validate = null, string $hint = ''): string
    {
        return (new SuggestPrompt(...func_get_args()))->prompt();
    }

    protected function search(
        string      $label,
        Closure     $options,
        string      $placeholder = '',
        int         $scroll = 5,
        mixed       $validate = null,
        string      $hint = '',
        bool|string $required = true
    ): int|string
    {
        return (new SearchPrompt(...func_get_args()))->prompt();
    }

    protected function multiSearch(
        string      $label,
        Closure     $options,
        string      $placeholder = '',
        int         $scroll = 5,
        bool|string $required = false,
        mixed       $validate = null,
        string      $hint = 'Use the space bar to select options.'
    ): array
    {
        return (new MultiSearchPrompt(...func_get_args()))->prompt();
    }

    protected function spin(Closure $callback, string $message = ''): mixed
    {
        return (new Spinner($message))->spin($callback);
    }

    protected function note(string $message, ?string $type = null): void
    {
        (new Note($message, $type))->display();
    }

    protected function error(string $message): void
    {
        (new Note($message, 'error'))->display();
    }

    protected function warning(string $message): void
    {
        (new Note($message, 'warning'))->display();
    }

    protected function alert(string $message): void
    {
        (new Note($message, 'alert'))->display();
    }

    protected function info(string $message): void
    {
        (new Note($message, 'info'))->display();
    }

    protected function intro(string $message): void
    {
        (new Note($message, 'intro'))->display();
    }

    protected function outro(string $message): void
    {
        (new Note($message, 'outro'))->display();
    }

    protected function table(array|Collection $headers = [], array|Collection|null $rows = null): void
    {
        (new Table($headers, $rows))->display();
    }

    protected function progress(
        string       $label,
        iterable|int $steps,
        ?Closure     $callback = null,
        string       $hint = ''
    ): array|Progress
    {
        $progress = new Progress($label, $steps, $hint);

        if ($callback !== null) {
            return $progress->map($callback);
        }

        return $progress;
    }

    protected function form(): FormBuilder
    {
        return new FormBuilder();
    }
}