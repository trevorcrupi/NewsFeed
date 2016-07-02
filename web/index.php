<?php

$container = require __DIR__ . '/../bootstrap/bootstrap.php';

$kernel = new \Http\Kernel;

$router = new \Nucleus\Routing\Router($kernel);
$routes = require __DIR__ . '/../app/Http/Routes.php';
