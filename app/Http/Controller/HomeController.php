<?php

namespace Http\Controller;

use Persistence\Repositories\ArticleRepository;
use Persistence\Repositories\UserRepository;
use Twig_Environment;
use \Nucleus\Utilities;

class HomeController
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @var UserRepository
     */
     private $repo;

    public function __construct(ArticleRepository $repository, UserRepository $repo, Twig_Environment $twig)
    {
        $this->repository = $repository;
        $this->repo = $repo;
        $this->twig = $twig;
    }

    /**
     * Example of an invokable class, i.e. a class that has an __invoke() method.
     *
     * @see http://php.net/manual/en/language.oop5.magic.php#object.invoke
     */
    public function home()
    {
        echo $this->twig->render('home.twig', [
            'articles' => $this->repository->getArticles(),
            'user'     => $this->repo->getUser( session('id') )
        ]);
    }
}
