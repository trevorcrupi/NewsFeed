<?php

trait ProviderTrait
{
  public $dependencies;
  public $registered = [];

  public function registerDependecies()
  {
    foreach($this->dependencies as $name => $depend)
    {
      $this->registered[$name] = $depend->register();
    }
  }

  public function getRegistered()
  {
    return $this->registered;
  }
}

class Middleman
{
  use ProviderTrait;
}

class TestA extends Middleman
{
  public function register()
  {
    return [
      "hello" => "Hey!"
    ];
  }
}

class TestB extends Middleman
{
  public function register()
  {
    return [
      "hey" => "Hello!"
    ];
  }
}

$middleman = new Middleman;
$middleman->dependencies = ["testa" => new TestA, "testb" => new TestB];
$middleman->registerDependecies();
echo "<pre>";
var_dump($middleman->getRegistered());
echo "</pre>";
