<?php declare(strict_types = 1);

namespace App\Http\Controller;

use Slim\Http\Request;
use Slim\Http\Response;

final class HomeController extends AbstractController
{
    /**
     * @param Request  $request
     * @param Response $response
     *
     * @return Response
     */
    public function index(Request $request, Response $response): Response
    {
        return $this->render($response, 'home.twig');
    }
}
