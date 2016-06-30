<?php

namespace Provider;

use function DI\object;
use function DI\get;
use Model\MessageRepository;
use Persistence\MessageMapper;

class MessageMapperProvider extends Provider
{
  public function register()
  {
    return [];
  }
}
