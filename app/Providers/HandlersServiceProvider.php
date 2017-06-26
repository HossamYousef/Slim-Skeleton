<?php

namespace App\Providers;

use Pimple\Container;

final class HandlersServiceProvider extends AbstractServiceProvider
{
    /**
     * Register error handlers service provider.
     *
     * @param Container $container
     */
    public function register(Container $container)
    {
        $container['errorHandler'] = function ($container) {
            return function ($request, $response, $exception) use ($container) {
                $statusCode = $exception->getCode() ? $exception->getCode() : 500;
                $details    = ($container['settings']['displayErrorDetails']) ? $exception->getMessage() : 'Internal server error.';

                $res = $container['response']
                    ->withStatus($statusCode)
                    ->withHeader('Content-Type', 'text/html');

                return $container['view']->render(
                    $res,
                    'errors/500.twig',
                    [
                        'status_code'   => $res->getStatusCode(),
                        'reason_phrase' => $res->getReasonPhrase(),
                        'details'       => $details,
                    ]
                );
            };
        };

        //Override the default Not Found Handler
        $container['notFoundHandler'] = function ($container) {
            return function ($request, $response) use ($container) {
                $res = $container['response']
                    ->withStatus(404)
                    ->withHeader('Content-Type', 'text/html');

                return $container->view->render(
                    $res,
                    'errors/404.twig',
                    [
                        'status_code'   => $res->getStatusCode(),
                        'reason_phrase' => $res->getReasonPhrase(),
                    ]
                );
            };
        };

        $container['notAllowedHandler'] = function ($container) {
            return function ($request, $response, $methods) use ($container) {
                $res = $container['response']
                    ->withStatus(405)
                    ->withHeader('Allow', implode(', ', $methods))
                    ->withHeader("Access-Control-Allow-Methods", implode(",", $methods))
                    ->withHeader('Content-Type', 'text/html');

                return $container->view->render(
                    $res,
                    'errors/405.twig',
                    [
                        'status_code'   => $res->getStatusCode(),
                        'reason_phrase' => $res->getReasonPhrase(),
                        'methods'       => 'Method must be one of: ' . implode(', ', $methods),
                    ]
                );
            };
        };

        $container['phpErrorHandler'] = function ($container) {
            return function ($request, $response, $error) use ($container) {
                $statusCode = $error->getCode() ? $error->getCode() : 500;
                $details    = ($container['settings']['displayErrorDetails']) ? $error->getMessage() : 'Internal server error.';

                $res = $container['response']
                    ->withStatus($statusCode)
                    ->withHeader('Content-Type', 'text/html');

                return $container['view']->render(
                    $res,
                    'errors/500.twig',
                    [
                        'status_code'   => $res->getStatusCode(),
                        'reason_phrase' => $res->getReasonPhrase(),
                        'details'       => $details,
                    ]
                );
            };
        };
    }
}
