<?php
// show_message.php <id>
use Model\Message;

require_once __DIR__ . "/../bootstrap/database.php";

$id = $argv[1];
$message = $entityManager->find(Message::class, $id);

if ($message === null) {
    echo "No message found.\n";
    exit(1);
}

echo sprintf("-%s\n", $message->getText());
