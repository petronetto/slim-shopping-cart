<?php

namespace Cart\Controllers;

use Cart\Services\BasketService;

class OrderController extends BaseController
{
    public function index(BasketService $basket)
    {
        $basket->refresh();

        if (!$basket->subTotal()) {
            return $this->response->withRedirect(
                $this->router->pathFor('cart.index')
            );
        }

        return $this->view->render($this->response, 'order/index.html');
    }
}
