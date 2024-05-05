<?php

namespace Cosmo;

use Cosmo\Commands\PublishCosmo;
use Stellar\Provider;

class CosmoProvider extends Provider
{
    public const string COSMO_SETTING = 'cosmo.styles';

    public static function commands(): array
    {
        return [
            PublishCosmo::class,
        ];
    }

    public static function settings(): array
    {
        return [
            __DIR__ . '/../settings/cosmo.php',
        ];
    }
}