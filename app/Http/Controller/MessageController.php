<?php

namespace Http\Controller;

use Persistence\Repositories\MessageRepository;
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

    public function __construct(MessageRepository $repository, Twig_Environment $twig)
    {
      $this->repository = $repository;
      $this->twig = $twig;
    }

    public function all()
    {
      $messages = $this->repository->getMessages();
      echo $this->twig->render('messages.twig', [
        'messages' => $messages
      ]);
    }

    public function read()
    {
      $messages = $this->repository->getMessages();
      echo $this->twig->render('messages-api.twig', [
        'messages' => $messages
      ]);
    }

    public function show($id)
    {
      $message = $this->repository->getMessage($id);

      echo $this->twig->render('message.twig', [
        'message' => $message
      ]);
    }

    public function add()
    {
      $text = $_POST['message_text'];
      if($this->repository->save($text)) {
        echo "Saved!!!";
      }
    }
}
