<?php

use Model\Message;

require_once __DIR__ . "/../bootstrap/database.php";

$newMessage = $argv[1];

$message = new Message();
$message->setText($newMessage);

$entityManager->persist($message);
$entityManager->flush();

echo "Created Message with ID " . $message->getId() . "\n";
