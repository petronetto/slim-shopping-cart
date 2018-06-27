<?php

namespace Cart\Middleware;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class OldInputMiddleware
{
    protected $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function __invoke(Request $request, Response $response, $next)
    {
        if ($_SESSION['old']) {
            $this->view->getEnvironment()->addGlobal('old', $_SESSION['old']);
            // unset($_SESSION['errors']);
        }

        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);

        return $response;
    }
}
