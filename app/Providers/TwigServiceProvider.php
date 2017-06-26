<?php

namespace App\Providers;

use Pimple\Container;

final class TwigServiceProvider extends AbstractServiceProvider
{
    /**
     * Get default settings
     *
     * @return array
     */
    public static function getDefaultSettings()
    {
        return [
            'template_path'     => RESOURCESS_PATH . '/view',
            'template_settings' => [
                'cache'       => STORAGE_PATH . '/cache/twig',
                'debug'       => true,
                'auto_reload' => true,
            ],
        ];
    }

    /**
     * Register Twig service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config = array_merge(self::getDefaultSettings(), $container['settings']['view']);

        $container['view'] = function ($container) use ($config) {
            $view = new \Slim\Views\Twig(
                $config['template_path'],
                $config['template_settings']
            );

            $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');

            $view->addExtension(new \Slim\Views\TwigExtension($container->get('router'), $basePath));

            return $view;
        };
    }
}
