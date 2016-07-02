<?php

namespace Http\Controller;

use Persistence\Repositories\UserRepository;
use Nucleus\Utilities;
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
      $this->repository->login(
        $this->repository->getUserIdByUsername($request['user_name'])
      );
      header('Location: http://localhost:8080/'.$request['user_name']);
    }

    public function profile( $user_name )
    {
      $user = $this->repository->getUser(
        $this->repository->getUserIdByUsername($user_name)
      );

      echo $this->twig->render('profile.twig', [
        'profile' => $user,
        'user'    => $this->repository->getUser( session('id') )
      ]);
    }

    public function login()
    {
      echo $this->twig->render('login.twig', []);
    }

    public function register()
    {
      echo $this->twig->render('register.twig', []);
    }

    public function loginUser()
    {
      $request = [
        "user_name"      => $_POST['user_name'],
        "user_password" => $_POST['user_password']
      ];

      $user = $this->repository->getUser(
        $this->repository->getUserIdByUsername($request["user_name"])
      );

      if(!$user)
        redirect("/login");

      if(!password_verify($request["user_password"], $user->getUserPasswordHash()))
        redirect("/login");

      $this->repository->login($user->getId());
      redirect();
    }

    public function logout()
    {
      $this->repository->logout();
      header("Location: /login");
    }
}
