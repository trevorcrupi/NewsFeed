<?php

namespace Http;

class Kernel
{
  public $middleware = [
    "auth" => \Http\Middleware\Authenticate::class,
    "reverseAuth" => \Http\Middleware\ReverseAuthenticate::class,
  ];
}
