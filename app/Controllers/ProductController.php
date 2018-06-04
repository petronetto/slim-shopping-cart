<?php

namespace Cart\Controllers;

use Cart\Models\Product;
use Slim\Router;

class ProductController extends BaseController
{
    public function get(string $slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            return $this->response->withRedirect($this->router->pathFor('home'));
        }

        return $this->view->render($this->response, 'products/product.html', [
            'product' => $product,
        ]);
    }
}
