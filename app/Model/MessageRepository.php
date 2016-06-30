<?php

namespace Model;

/**
 * This is an interface so that the model is coupled to a specific backend.
 *
 * This is also so that we can demonstrate how to bind an interface
 * to an implementation with PHP-DI.
 */
interface MessageRepository
{
    /**
     * @return Message[]
     */
    public function getMessages();

    /**
     * @param string $id
     * @return Message
     */
    public function getMessage($id);

    /**
     * @param string $text
     * @return bool
     */
     public function save($text);
}
