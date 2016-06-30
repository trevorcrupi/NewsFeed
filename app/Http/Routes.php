<?php

use Nucleus\Routing\Router;

$router = new Router;

$router->get("/", "HomeController");
$router->get("/article/{id}", "ArticleController@show");
$router->get("/inbox", "MessageController@all");
$router->get("/messages/{id}", "MessageController@show");

$router->get("/api/v1/messages", "MessageController@read");

$router->post("/add/message", "MessageController@add");

return $router->dispatch($container);
