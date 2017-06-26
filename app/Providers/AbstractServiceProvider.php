<?php

namespace App\Providers;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    /**
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [];
    }

    /**
     * Register service
     *
     * @param Container $container
     *
     * @return void
     */
    abstract public function register(Container $container);
}
