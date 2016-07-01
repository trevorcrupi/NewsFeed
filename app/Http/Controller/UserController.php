<?php

namespace Http\Controller;

use Persistence\Repositories\UserRepository;
use Twig_Environment;

class UserController
{
  /**
   * @var Message Repository
   */
   private $repository;

   /**
    * @var Twig_Environment
    */
    private $twig;

    public function __construct(UserRepository $repository, Twig_Environment $twig)
    {
      $this->repository = $repository;
      $this->twig = $twig;
    }

    public function add()
    {
      $request = [
        "user_name"     => $_POST['user_name'],
        "user_email"    => $_POST['user_email'],
        "user_password" => $_POST['user_password']
      ];

      $this->repository->save($request['user_name'], $request['user_email'], $request['user_password']);
      header('Location: http://localhost:8080/'.$request['user_name']);
    }

    public function profile( $user_name )
    {
      $user = $this->repository->getUser(
        $this->repository->getUserIdByUsername($user_name)
      );
      
      echo $this->twig->render('profile.twig', [
        'user' => $user
      ]);
    }
}
