<?php

namespace Cart\Controllers;

use Cart\Services\BasketService;
use Cart\Validation\Forms\OrderForm;

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

    public function create(BasketService $basket)
    {
        $basket->refresh();

        if (!$basket->subTotal()) {
            return $this->response->withRedirect(
                $this->router->pathFor('cart.index')
            );
        }

        $validation = $this->validator->validate($this->request, OrderForm::rules());

        if ($validation->fails()) {
            return $this->response->withRedirect(
                $this->router->pathFor('order.index')
            );
        }
    }
}
