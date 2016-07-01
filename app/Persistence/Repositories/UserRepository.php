<?php

namespace Persistence\Repositories;

interface UserRepository
{
  /**
   * @param string $id
   * @return User
   */
  public function getUser($id);

  /**
   * @param string $text
   * @return bool
   */
   public function save($user_name, $user_email, $password);

   /**
    * @param string $user_name
    * @return User
    */
    public function getUserIdByUsername($user_name);
}
