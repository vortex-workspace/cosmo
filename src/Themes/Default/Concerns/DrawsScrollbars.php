<?php

namespace Cosmo\Themes\Default\Concerns;


use Stellar\Facades\Collection;

trait DrawsScrollbars
{
    /**
     * Render a scrollbar beside the visible items.
     *
     * @param  Collection<int, string>  $visible
     * @return Collection<int, string>
     */
    protected function scrollbar(Collection $visible, int $firstVisible, int $height, int $total, int $width, string $color = 'cyan'): Collection
    {
        if ($height >= $total) {
            return $visible;
        }

        $scrollPosition = $this->scrollPosition($firstVisible, $height, $total);

        return $visible
            ->values()
            ->map(fn ($line) => $this->pad($line, $width))
            ->map(fn ($line, $index) => match ($index) {
                $scrollPosition => preg_replace('/.$/', $this->{$color}('┃'), $line),
                default => preg_replace('/.$/', $this->gray('│'), $line),
            });
    }

    /**
     * Return the position where the scrollbar "handle" should be rendered.
     */
    protected function scrollPosition(int $firstVisible, int $height, int $total): int
    {
        if ($firstVisible === 0) {
            return 0;
        }

        $maxPosition = $total - $height;

        if ($firstVisible === $maxPosition) {
            return $height - 1;
        }

        if ($height <= 2) {
            return -1;
        }

        $percent = $firstVisible / $maxPosition;

        return (int) round($percent * ($height - 3)) + 1;
    }
}
