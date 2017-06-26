<?php

/*
|--------------------------------------------------------------------------
| Define constant
|--------------------------------------------------------------------------
 */
defined('BASE_ROOT') || define('BASE_ROOT', dirname(__DIR__));
defined('VENDOR_PATH') || define('VENDOR_PATH', BASE_ROOT . '/vendor');
defined('APP_PATH') || define('APP_PATH', BASE_ROOT . '/app');
defined('CONFIG_PATH') || define('CONFIG_PATH', BASE_ROOT . '/config');
defined('RESOURCESS_PATH') || define('RESOURCESS_PATH', BASE_ROOT . '/resources');
defined('STORAGE_PATH') || define('RESOURCESS_PATH', BASE_ROOT . '/storage');

/*
|--------------------------------------------------------------------------
| Composer auto loader
|--------------------------------------------------------------------------
 */
require_once VENDOR_PATH . '/autoload.php';

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
try {
    (new \Dotenv\Dotenv(BASE_ROOT))->load();
} catch (\Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Load application settings
|--------------------------------------------------------------------------
 */
$settings = require CONFIG_PATH . '/settings.php';

date_default_timezone_set($settings['settings']['timezone']);

/*
|--------------------------------------------------------------------------
| Create container for application
|--------------------------------------------------------------------------
 */
$container = new \Slim\Container($settings);

/*
|--------------------------------------------------------------------------
| Register service providers & factories
|--------------------------------------------------------------------------
 */
$container->register(new \App\Providers\HandlersServiceProvider());
$container->register(new \App\Providers\HttpCacheServiceProvider());
$container->register(new \App\Providers\TwigServiceProvider());
$container->register(new \App\Providers\LoggerServiceProvider());
$container->register(new \App\Providers\DatabaseServiceProvider());
$container->register(new \App\Providers\MailerServiceProvider());

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
 */
$app = new \Slim\App($container);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
 */
$app->add(new \Slim\HttpCache\Cache('public', 86400));

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
 */
require APP_PATH . '/Http/routes.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
 */
$app->run();
