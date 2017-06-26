<?php
/**
 * This file is part of `oanhnn/slim-skeleton` project.
 *
 * (c) Oanh Nguyen <oanhnn.bk@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace App\Providers;

use Pimple\Container;
use Slim\HttpCache\CacheProvider;

/**
 * Http cache service provider
 */
final class HttpCacheServiceProvider extends AbstractServiceProvider
{
    /**
     * Register Http Cache Service Provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $provider = new CacheProvider();
        $provider->register($container);
    }
}
