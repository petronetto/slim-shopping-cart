<?php

namespace Cart\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Router;
use Slim\Views\Twig;

class BaseController
{
    protected $request;
    protected $response;
    protected $view;
    protected $router;

    public function __construct(
        Request $request,
        Response $response,
        Twig $view,
        Router $router
    ) {
        $this->request  = $request;
        $this->response = $response;
        $this->view     = $view;
        $this->router   = $router;
    }
}
