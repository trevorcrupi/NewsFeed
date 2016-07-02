<?php

namespace Http\Middleware;

use Nucleus\Utilites;

class Authenticate
{
  public function handle(\Closure $callback)
  {
    if(!logged_in()) {
      header("Location: /login");
    }

    return $callback();
  }
}
