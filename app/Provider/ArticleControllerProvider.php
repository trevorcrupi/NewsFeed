<?php

namespace Provider;

use function DI\object;
use function DI\get;
use Persistence\Repositories\ArticleRepository;
use Persistence\InMemoryArticleRepository;

class ArticleControllerProvider extends Provider
{

  public function register()
  {
    return [
      // Bind an interface to an implementation
      ArticleRepository::class => object(InMemoryArticleRepository::class),
      'hello' => [
          get(HelloWorld::class)
      ],
    ];
  }

}
