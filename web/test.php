<?php

class Http
{
  public function save($http, $callback)
  {
    $this->methods[$http][$url] = $callback;
  }

  public function __call($name, $arguments)
  {
    $this->save( $name, $arguments[0], $arguments[1] );
  }
}

$http = new Http;

$http->post("/trevorcrupi", function() {
  echo "Hello!";
});
// Hello, World!
