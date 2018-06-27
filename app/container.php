<?php

use Cart\Basket\BasketManager;
use Cart\Models\Product;
use Cart\Services\BasketService;
use Cart\Support\Storage\Contracts\StorageInterface;
use Cart\Support\Storage\SessionStorage;
use Cart\Validation\Contracts\ValidatiorInterface;
use Cart\Validation\Validatior;
use Psr\Container\ContainerInterface as Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Interfaces\RouterInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;

return [
    ServerRequestInterface::class => function (Container $c) {
        return $c->get('request');
    },
    ResponseInterface::class      => function (Container $c) {
        return $c->get('response');
    },
    RouterInterface::class        => function (Container $c) {
        return $c->get('router');
    },
    ValidatiorInterface::class    => function (Container $c) {
        return new Validatior;
    },
    StorageInterface::class       => function (Container $c) {
        return new SessionStorage('cart');
    },
    Twig::class => function (Container $c) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' => false,
        ]);

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        $twig->getEnvironment()->addGlobal('basket', $c->get(BasketService::class));

        return $twig;
    },
    BasketManager::class => function (Container $c) {
        return new BasketManager(
            $c->get(SessionStorage::class),
            $c->get(Product::class)
        );
    }
];
