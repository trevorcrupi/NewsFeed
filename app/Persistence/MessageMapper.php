<?php

namespace Persistence;

use Model\Message;
use Model\MessageRepository;
use Doctrine\ORM\EntityManager;

class MessageMapper implements MessageRepository
{
    private $messages;

    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->messages = $this->entityManager->getRepository(Message::class);
    }

    public function save($text)
    {
      $message = new Message();
      $message->setText($text);
      $this->entityManager->persist($message);
      $this->entityManager->flush();
    }

    public function getMessages()
    {
        return $this->messages->findAll();
    }

    public function getMessage($id)
    {
        return $this->messages->find($id);
    }
}
