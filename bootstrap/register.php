<?php

use function DI\object;
use Doctrine\ORM\EntityManager;

global $entityManager;

return [
    EntityManager::class => $entityManager,

    // Configure Twig
    Twig_Environment::class => function () {
        $loader = new Twig_Loader_Filesystem(__DIR__ . '/../resources/views');
        return new Twig_Environment($loader);
    },
];
