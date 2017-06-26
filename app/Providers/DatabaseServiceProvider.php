<?php

namespace App\Providers;

use Illuminate\Container\Container as IlluminateContainer;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Pimple\Container;

final class DatabaseServiceProvider extends AbstractServiceProvider
{
    /**
     * Register database service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $config  = $container['settings'];
        $capsule = new Capsule();

        $capsule->addConnection($config['database']['connections']);

        $capsule->setEventDispatcher(new Dispatcher(new IlluminateContainer()));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $container['database'] = $capsule->getDatabaseManager();
    }
}
