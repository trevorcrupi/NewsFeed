<?php

namespace Nucleus\Provider;

trait ProviderTrait
{

  private $registered = [];

  public $dependencies;

  public function register()
  {
    foreach($this->dependencies as $name => $obj)
    {
      $this->registered[$name] = $obj->register();
    }
  }

  public function getRegistered()
  {
    return $this->registered;
  }
}
