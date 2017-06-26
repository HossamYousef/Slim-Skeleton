<?php declare(strict_types = 1);

namespace App\Http\Middleware;

use Interop\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractMiddleware
{
    /**
     *
     *
     * @var \Interop\Container\ContainerInterface Stores slim container
     */
    protected $container;

    /**
     * Middleware Contructor.
     *
     * @param \Interop\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Magic getter for access to Slim container.
     *
     * @param String $name Name of parameter to lookup
     */
    public function __get($name)
    {
        return $this->container->get($name);
    }

    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param callable               $next
     *
     * @return Response
     */
    abstract public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface;
}
