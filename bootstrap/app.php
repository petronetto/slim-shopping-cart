<?php

use Cart\App;
use Cart\Middleware\OldInputMiddleware;
use Cart\Middleware\ValidationErrorsMiddleware;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Views\Twig;

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new App;

$contianer = $app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'cart.mysql',
    'port'      => 3306,
    'database'  => 'cart',
    'username'  => 'admin',
    'password'  => 'secret',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../app/routes.php';

$app->add(new ValidationErrorsMiddleware($contianer->get(Twig::class)));
$app->add(new OldInputMiddleware($contianer->get(Twig::class)));
