<?php

namespace Http\Controller;

use Persistence\Repositories\UserRepository;
use Nucleus\Http\Controller; 
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
      redirect("/".$request['user_name']);
    }

    public function profile( $user_name )
    {
      $user = $this->repository->getUser(
        $this->repository->getUserIdByUsername($user_name)
      );

      $following = $this->repository->getForwardEdges($user->id);


      if($user->id !== session('id'))
        $isFollowing = $this->repository->isFollowing(session('edges.connection_edges_forward'), $user->id);
      else
        $isFollowing = false;

      echo $this->twig->render('profile.twig', [
        'profile'      => $user,
        'url'          => $_SERVER['REQUEST_URI'],
        'session'      => session(),
        'following'    => $following,
        'followers'    => $this->repository->getReverseEdges($user->id),
        'is_following' => $isFollowing
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
        "user_password"  => $_POST['user_password']
      ];

      $user = $this->repository->getUser(
        $this->repository->getUserIdByUsername($request["user_name"])
      );

      if(!$user) {
        redirect("/login");
        return;
      }

      if(!password_verify($request["user_password"], $user->getUserPasswordHash())) {
        redirect("/login");
        return;
      }

      // Construct Social Graph - Save in session
      $connection_edges_forward = $this->repository->getForwardEdges($user->getId());
      $connection_edges_reverse = $this->repository->getReverseEdges($user->getId());


      $this->repository->login($user, [
        "forward" => $connection_edges_forward,
        "reverse" => $connection_edges_reverse
      ]);
      redirect();
    }

    public function follow($id)
    {
      $this->repository->follow(session("id"), $id);

      if(isset($_GET['to']))
        redirect($_GET['to']);
      else
        redirect();
    }

    public function unfollow($id)
    {
      $this->repository->unfollow(session("id"), $id);

      if(isset($_GET['to']))
        redirect($_GET['to']);
      else
        redirect();
    }

    public function logout()
    {
      $this->repository->logout();
      redirect("/login");
    }
}
