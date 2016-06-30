<?php

namespace Provider;

use function DI\object;
use Model\MessageRepository;
use Persistence\MessageMapper;

class MessageControllerProvider extends Provider
{
  public function register()
  {
    return [
      MessageRepository::class => object(MessageMapper::class),
    ];
  }
}
