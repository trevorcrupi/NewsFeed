<?php

namespace Http\Middleware;

use Nucleus\Utilites;

class ReverseAuthenticate
{
  public function handle(\Closure $callback)
  {
    if(logged_in())
      return header("Location: /");

    return $callback();
  }
}
