<?php

namespace Cart\Controllers;

use Cart\Models\Product;
use Cart\Services\BasketService;

class HomeController extends BaseController
{
    public function index(BasketService $basket)
    {
        $products = Product::all();

        return $this->view->render($this->response, 'home.html', [
            'products' => $products,
        ]);
    }
}
