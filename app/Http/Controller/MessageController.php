<?php

namespace Http\Controller;

use Persistence\Repositories\MessageRepository;
use Persistence\Repositories\UserRepository;
use Nucleus\Utilities;
use Twig_Environment;

class MessageController
{
  /**
   * @var Message Repository
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

    public function __construct(MessageRepository $repository, UserRepository $repo, Twig_Environment $twig)
    {
        $this->repository = $repository;
        $this->repo = $repo;
        $this->twig = $twig;
    }


    public function all()
    {
      $messages = $this->repository->getMessages();
      echo $this->twig->render('messages.twig', [
        'messages' => $messages,
        'user'     => $this->repo->getUser( session('id') )
      ]);
    }

    public function show($id)
    {
      $message = $this->repository->getMessage($id);

      echo $this->twig->render('message.twig', [
        'message' => $message,
        'user'    => $this->repo->getUser( session('id') )
      ]);
    }

    public function add()
    {
      $text = $_POST['message_text'];
      $this->repository->save($text);
      redirect("/inbox");
    }
}
