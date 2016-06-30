<?php
// list_messages.php
use Model\Message;

require_once __DIR__ . "/../bootstrap/database.php";

$messageRepository = $entityManager->getRepository(Message::class);
$messages = $messageRepository->findAll();

foreach ($messages as $message) {
    echo sprintf("-%s\n", $message->getText());
}
