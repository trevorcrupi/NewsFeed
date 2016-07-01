<?php

namespace Model;

/**
 * @Entity @Table(name="users")
**/
class User
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  public $id;

  /** @Column(type="string", length=32, nullable=false, unique=true) **/
  public $user_name;

  /** @Column(type="string", length=100, nullable=false, unique=true) **/
  public $user_email;

  /** @Column(type="string", length=255, nullable=false) **/
  public $user_password_hash;

  /** @Column(type="datetime") **/
  public $updated;

  public function getId()
  {
    return $this->id;
  }

  public function getUserName()
  {
    return $this->user_name;
  }

  public function getUserEmail()
  {
    return $this->user_email;
  }

  public function getUserPasswordHash()
  {
    return $this->user_password_hash;
  }

  public function getUpdated()
  {
    return $this->updated;
  }

  public function setUserName( $user_name )
  {
    $this->user_name = $user_name;
  }

  public function setUserEmail( $user_email )
  {
    $this->user_email = $user_email;
  }

  public function setUserPasswordHash( $password )
  {
    $options = [
      "cost" => 9
    ];

    $this->user_password_hash = password_hash($password, PASSWORD_DEFAULT, $options);
  }

  public function setUpdated()
  {
     $this->updated = new \DateTime("now");
  }
}
