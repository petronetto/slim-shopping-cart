<?php

namespace Cart\Controllers;

use Cart\Services\BasketService;
use Cart\Validation\Forms\OrderForm;
use Cart\Models\Customer;
use Cart\Models\Address;

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

    public function create(BasketService $basket, Customer $customer, Address $address)
    {
        $basket->refresh();

        if (!$basket->subTotal()) {
            return $this->response->withRedirect(
                $this->router->pathFor('cart.index')
            );
        }

        $validation = $this->validator->validate($this->request, OrderForm::rules());

        // if ($validation->fails()) {
        //     return $this->response->withRedirect(
        //         $this->router->pathFor('order.index')
        //     );
        // }

        $hash = bin2hex(random_bytes(32));

        $customer = $customer->firstOrCreate([
            'email' => $this->request->getParam('email'),
            'name'  => $this->request->getParam('name'),
        ]);

        $address = $address->firstOrCreate([
            'address1' => $this->request->getParam('address1'),
            'address2' => $this->request->getParam('address2'),
            'city'     => $this->request->getParam('city'),
            'zipcode'  => $this->request->getParam('zipcode'),
        ]);

        $order = $customer->orders()->create([
            'hash'       => $hash,
            'paid'       => false,
            'total'      => $basket->subTotal() + 5,
            'address_id' => $address->id,
        ]);

        $items = $basket->all();

        $order->products()->saveMany($items, $this->getQuantities($items));
    }

    private function getQuantities($items)
    {
        $quantities = [];

        foreach ($items as $item) {
            $quantities[] = ['quantity' => $item->quantity];
        }

        return $quantities;
    }
}
