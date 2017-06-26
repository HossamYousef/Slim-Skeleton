<?php declare (strict_types = 1);

namespace App\Http\Controller;

use Pimple\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Abstract controller class
 */
abstract class AbstractController
{
    /**
     *
     *
     * @var \Pimple\Container Stores slim container
     */
    protected $container;

    /**
     * Controller Contructor.
     *
     * @param Container $container
     */
    public function __construct(Container $container)
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
     * Get request params
     *
     * @param Request  $request
     * @param string[] $params
     *
     * @return array
     */
    protected function params(Request $request, array $params): array
    {
        $data = [];

        foreach ($params as $param) {
            $data[$param] = $request->getParam($param);
        }

        return $data;
    }

    /**
     * Redirect to route
     *
     * @param Response $response
     * @param string   $route
     * @param array    $params
     *
     * @return Response
     */
    protected function redirect(Response $response, $route, array $params = []): Response
    {
        return $response->withRedirect($this->router->pathFor($route, $params));
    }

    /**
     * Redirect to url
     *
     * @param Response $response
     * @param string   $url
     *
     * @return Response
     */
    protected function redirectTo(Response $response, $url): Response
    {
        return $response->withRedirect($url);
    }

    /**
     * Write JSON in the response body
     *
     * @param Response $response
     * @param mixed    $data
     * @param int      $status
     *
     * @return Response
     */
    protected function json(Response $response, $data, $status = 200): Response
    {
        return $response->withJson($data, $status);
    }

    /**
     * Write text in the response body
     *
     * @param Response $response
     * @param string   $data
     * @param int      $status
     *
     * @return int
     */
    protected function write(Response $response, $data, $status = 200): Response
    {
        return $response->withStatus($status)->getBody()->write($data);
    }

    /**
     * Render a view.
     *
     * @param Response $response
     * @param string   $view
     * @param array    $data
     *
     * @return Response
     */
    protected function render(Response $response, $view, $data = []): Response
    {
        return $this->view->render($response, $view, $data);
    }
}
