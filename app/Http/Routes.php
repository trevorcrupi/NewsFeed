<?php

use Nucleus\Routing\Router;

$router = new Router;

// Home Page
$router->get("/", "HomeController");

$router->get("/article/{id}", "ArticleController@show");
$router->get("/inbox", "MessageController@all");
$router->get("/messages/{id}", "MessageController@show");

$router->get("/api/v1/messages", "MessageController@read");

$router->post("/add/message", "MessageController@add");
$router->post("/user", "UserController@add");

// Profile Page
$router->get("/{user_name}", "UserController@profile");

return $router->dispatch($container);
