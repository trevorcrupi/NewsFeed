<?php

namespace Http\Controller;

use Persistence\Repositories\ArticleRepository;
use Twig_Environment;

class ArticleController
{
    /**
     * @var ArticleRepository
     */
    private $repository;

    /**
     * @var Twig_Environment
     */
    private $twig;

    public function __construct(ArticleRepository $repository, Twig_Environment $twig)
    {
        $this->repository = $repository;
        $this->twig = $twig;

    }

    public function show($id, \HelloWorld $hello)
    {
        $article = $this->repository->getArticle($id);

        echo $this->twig->render('article.twig', [
            'article' => $article,
            'message' => $hello->sayHello()
        ]);
    }
}
