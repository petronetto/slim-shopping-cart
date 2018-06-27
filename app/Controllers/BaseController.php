<?php

namespace Cart\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Router;
use Slim\Views\Twig;
use Cart\Validation\Contracts\ValidatiorInterface as Validator;

class BaseController
{
    protected $request;
    protected $response;
    protected $view;
    protected $router;
    protected $validator;

    public function __construct(
        Request $request,
        Response $response,
        Twig $view,
        Router $router,
        Validator $validator
    ) {
        $this->request   = $request;
        $this->response  = $response;
        $this->view      = $view;
        $this->router    = $router;
        $this->validator = $validator;
    }
}
