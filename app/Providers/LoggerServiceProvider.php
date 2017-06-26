<?php

namespace App\Providers;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Pimple\Container;

final class LoggerServiceProvider extends AbstractServiceProvider
{
    /**
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [
            'name'  => 'app',
            'path'  => STORAGE_PATH . '/logger/app.log',
            'level' => Logger::DEBUG,
        ];
    }

    /**
     * Register Logger service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config = array_merge(self::getDefaultSettings(), $container['settings']['logger']);

        $container['logger'] = function () use ($config) {
            $logger = new Logger($config['name']);
            $logger->pushProcessor(new UidProcessor());
            $logger->pushHandler(
                new StreamHandler(
                    $config['path'],
                    $config['level']
                )
            );

            return $logger;
        };
    }
}
