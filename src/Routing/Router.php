<?php

namespace Nucleus\Routing;

use Nucleus\Utilities;
use FastRoute\RouteCollector;
use FastRoute\Dispatcher;

class Router
{

  private $dispatcher;

  private $group = array();

  public function get($uri, $controllerAction)
  {
    if(contains($controllerAction, "@")) {
      $controllerAction = splitString("@", $controllerAction, [0, "Http\\Controller\\"]);
    } else {
      $controllerAction = "Http\\Controller\\".$controllerAction;
    }

    $this->group["GET"][$uri] = $controllerAction;
  }

  public function post($uri, $controllerAction)
  {
    if(contains($controllerAction, "@")) {
      $controllerAction = splitString("@", $controllerAction, [0, "Http\\Controller\\"]);
    } else {
      $controllerAction = "Http\\Controller\\".$controllerAction;
    }

    $this->group["POST"][$uri] = $controllerAction;
  }

  public function getDispatcher()
  {
    return $this->dispatcher;
  }

  public function dispatch($container)
  {
    $this->dispatcher = \FastRoute\simpleDispatcher(function (RouteCollector $r) {
        //$r->addRoute('GET', '/', 'Http\Controller\HomeController');
        //$r->addRoute('GET', '/article/{id}', ['Http\Controller\ArticleController', 'show']);

        // Add 'GET' Routes
        foreach($this->group["GET"] as $pattern => $route)
          $r->addRoute("GET", $pattern, $route);

          // Add 'POST' routes, but only if they exist.
          if(isset($this->group["POST"]))
            foreach($this->group["POST"] as $pattern => $route)
              $r->addRoute("POST", $pattern, $route);
    });

    $route = $this->getDispatcher()->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);

    switch ($route[0]) {
        case \FastRoute\Dispatcher::NOT_FOUND:
            echo '404 Not Found';
            break;

        case \FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            echo '405 Method Not Allowed';
            break;

        case \FastRoute\Dispatcher::FOUND:
            $controller = $route[1];
            $parameters = $route[2];

            // We could do $container->get($controller) but $container->call()
            // does that automatically
            $container->call($controller, $parameters);
            break;
    }
  }
}