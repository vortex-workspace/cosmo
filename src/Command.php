<?php

namespace Cosmo;

use Core\Contracts\CommandInterface;
use Cosmo\Command\Enums\CommandResponse;
use Cosmo\Command\Enums\ConsoleStyleOption;
use Cosmo\Command\Exceptions\InvalidOutputStyle;
use Cosmo\Command\OutputStyle;
use Cosmo\Command\OutputStyles\BlueBkg;
use Cosmo\Command\OutputStyles\BrightBlueBkg;
use Cosmo\Command\OutputStyles\BrightGreen;
use Cosmo\Command\OutputStyles\Cyan;
use Cosmo\Command\OutputStyles\Gray;
use Cosmo\Command\OutputStyles\GreenBkg;
use Cosmo\Command\OutputStyles\Red;
use Cosmo\Command\OutputStyles\RedBkg;
use Cosmo\Command\OutputStyles\YellowBkg;
use Cosmo\Command\Traits\Bells;
use Cosmo\Command\Traits\Blocks;
use Cosmo\Command\Traits\Defaults;
use Cosmo\Command\Traits\Inputs;
use Cosmo\Command\Traits\Permissions;
use Cosmo\Command\Traits\Rows;
use Cosmo\Command\Traits\Write;
use Error;
use Exception;
use Stellar\Boot\Application;
use Stellar\Setting;
use Stellar\Settings\Exceptions\InvalidSettingException;
use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends SymfonyCommand implements CommandInterface
{
    use Bells, Blocks, Defaults, Inputs, Permissions, Rows, Write;

    protected InputInterface $input;
    protected OutputInterface $output;

    abstract protected function name(): string;

    abstract protected function handle(): CommandResponse;

    public function __construct(?string $name = null)
    {
        parent::__construct($name ?? $this->name());

        if (!static::can(Application::getInstance()) || !static::canSee(Application::getInstance())) {
            $this->setHidden();
        }

        foreach ($this->arguments() as $argument) {
            $this->registerParameterByType($argument);
        }

        foreach ($this->options() as $option) {
            $this->registerParameterByType($option, false);
        }
    }

    /**
     * @return array<Argument>
     */
    protected function arguments(): array
    {
        return [];
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws InvalidOutputStyle
     * @throws InvalidSettingException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $commandResult = CommandResponse::FAILED;
        $this->startCommand($input, $output);

        if (self::can(Application::getInstance()) && self::canRun(Application::getInstance())) {
            try {
                $this->setRuntimeStart();

                $commandResult = $this->handle();
            } catch (Error|Exception $exception) {
                $this->exceptionBlock($exception);
            }
        }

        $this->endCommand($commandResult);

        return $commandResult->value;
    }

    /**
     * @return array<Option>
     */
    protected function options(): array
    {
        return [];
    }

    private function endCommand(CommandResponse $status): void
    {
        $this->writeCommandEnd($status);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return void
     * @throws InvalidOutputStyle
     * @throws InvalidSettingException
     */
    private function startCommand(InputInterface $input, OutputInterface $output): void
    {
        $this->input = $input;
        $this->output = $output;
        $this->loadStyles();
        $this->writeCommandStart();
    }

    /**
     * @param Option|Argument $parameter
     * @param bool $is_argument
     * @return void
     */
    private function registerParameterByType(Option|Argument $parameter, bool $is_argument = true): void
    {
        if ($is_argument && $parameter instanceof Argument) {
            $this->addArgument(...$parameter->toArray());

            return;
        }

        if ($parameter instanceof Option) {
            $this->addOption(...$parameter->toArray());
        }
    }

    /**
     * @return void
     * @throws InvalidOutputStyle
     * @throws InvalidSettingException
     */
    private function loadStyles(): void
    {
        foreach ($this->defaultStyles() as $style) {
            $this->loadStyle($style);
        }

        foreach (Setting::get(CosmoProvider::COSMO_SETTING, []) as $style) {
            $this->loadStyle($style);
        }
    }

    /**
     * @param string $style
     * @return void
     * @throws InvalidOutputStyle
     */
    private function loadStyle(string $style): void
    {
        if (!(($style = new $style) instanceof OutputStyle)) {
            throw new InvalidOutputStyle;
        }

        foreach (($options = $style->options()) as $index => $option) {
            if ($option instanceof ConsoleStyleOption) {
                $options[$index] = $option->value;
            }
        }

        $this->output->getFormatter()->setStyle(
            $style->name(),
            new OutputFormatterStyle($style->foreground()->value, $style->background()?->value, $options)
        );
    }

    private function defaultStyles(): array
    {
        return [
            BlueBkg::class,
            BrightBlueBkg::class,
            BrightGreen::class,
            Cyan::class,
            Gray::class,
            GreenBkg::class,
            Red::class,
            RedBkg::class,
            YellowBkg::class,
        ];
    }
}