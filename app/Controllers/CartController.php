<?php

namespace Cart\Controllers;

use Cart\Exceptions\QuantityExceededException;
use Cart\Models\Product;
use Cart\Services\BasketService;

class CartController extends BaseController
{
    public function index(BasketService $basket)
    {
        $basket->refresh();

        return $this->view->render($this->response, 'cart/index.html');
    }

    public function add(BasketService $basket, string $slug, int $quantity)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $this->response->withRedirect(
                $this->router->pathFor('home')
            );
        }

        try {
            $basket->add($product, $quantity);
        } catch (QuantityExceededException $e) {
            //
        }

        return $this->response->withRedirect(
            $this->router->pathFor('cart.index')
        );
    }

    public function update(BasketService $basket, string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $this->response->withRedirect(
                $this->router->pathFor('home')
            );
        }

        try {
            $basket->update($product, $this->request->getParam('quantity'));
        } catch (QuantityExceededException $e) {
            //
        }

        return $this->response->withRedirect(
            $this->router->pathFor('cart.index')
        );
    }
}
