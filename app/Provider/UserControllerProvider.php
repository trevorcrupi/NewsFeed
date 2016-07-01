<?php

namespace Provider;

use function DI\object;
use Persistence\Repositories\UserRepository;
use Persistence\UserMapper;

class UserControllerProvider extends Provider
{
  public function register()
  {
    return [
      UserRepository::class => object(UserMapper::class),
    ];
  }
}
