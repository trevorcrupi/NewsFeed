<?php

namespace Persistence;

use Model\User;
use Persistence\Repositories\UserRepository;
use Doctrine\ORM\EntityManager;
use Nucleus\Utilites;

class UserMapper implements UserRepository
{
  private $user;

  private $entityManager;

  private $queryBuilder;

  public function __construct(EntityManager $entityManager)
  {
    $this->entityManager = $entityManager;
    $this->queryBuilder = $this->getEntityManager()->createQueryBuilder('u');
    $this->user = $this->getEntityManager()->getRepository(User::class);
  }

  public function getUser( $id )
  {
    return $this->user->find($id);
  }

  public function login( $id )
  {
    set("id", $id);
    set("user_logged_in", true);
  }

  public function logout()
  {
    set("user_logged_in", false);
    destroy();
  }

  public function save($user_name, $user_email, $password)
  {
    $user = new User();
    $user->setUserName($user_name);
    $user->setUserEmail($user_email);
    $user->setUserPasswordHash($password);
    $user->setUpdated();

    $this->getEntityManager()->persist($user);
    $this->getEntityManager()->flush();
  }

  public function getUserIdByUsername($user_name)
  {
    $qb = $this->getEntityManager()->createQueryBuilder()->select('user.id')
                  ->from('Model\User', 'user')
                  ->where('user.user_name = :user_name')
                  ->setParameter("user_name", $user_name);
    $query = $qb->getQuery();
    return $query->getSingleResult();
  }

  public function getEntityManager()
  {
    return $this->entityManager;
  }

  public function query()
  {
    return $this->getQueryBuilder()->getQuery();
  }
}
