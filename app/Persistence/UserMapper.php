<?php

namespace Persistence;

use Model\User;
use Model\Follow;
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

  public function login( $user, $edges = [] )
  {
    set("id", $user->id);
    set("user", $user);
    set("user_logged_in", true);
    // session.edges.connection_edges_forward
    // session.edges.connection_edges_reverse
    set(["edges", "connection_edges_forward"], $edges["forward"]);
    set(["edges", "connection_edges_reverse"], $edges["reverse"]);
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

  public function follow($from, $to)
  {
    $follow = new Follow();
    $follow->setFollower($from);
    $follow->setFollowing($to);
    $follow->setAffinity(.5);

    $this->getEntityManager()->persist($follow);
    $this->getEntityManager()->flush();

    set(["edges", "connection_edges_forward"], $this->getForwardEdges($follow->getFollower()));
    set(["edges", "connection_edges_reverse"], $this->getReverseEdges($follow->getFollower()));
  }

  public function unfollow($from, $to)
  {
    $qb = $this->getEntityManager()->createQueryBuilder()->select('f.id')
                  ->from('Model\Follow', 'f')
                  ->where('f.follower = :follower AND f.following = :following')
                  ->setParameters(["follower" => $from, "following" => $to]);
    $query = $qb->getQuery();
    $result = $query->getSingleResult();

    $follow = $this->getEntityManager()->getRepository(Follow::class);

    $follow = $follow->find($result);
    $this->getEntityManager()->remove($follow);
    $this->getEntityManager()->flush();

    set(["edges", "connection_edges_forward"], $this->getForwardEdges($follow->getFollower()));
    set(["edges", "connection_edges_reverse"], $this->getReverseEdges($follow->getFollower()));
  }

  public function isFollowing($following, $id)
  {
    if(!$following)
      return false; 
    
    foreach($following as $user)
    {
      if($user->id == $id)
        return true;
    }

    return false;
  }

  public function getForwardEdges( $id )
  {
    $qb = $this->getEntityManager()->createQueryBuilder()->select('f.following')
                  ->from('Model\Follow', 'f')
                  ->where('f.follower = :follower')
                  ->setParameter("follower", $id);
    $query = $qb->getQuery();
    $result = $query->getScalarResult();
    $connection_edges_forward = array_map([$this, "getUser"], array_map('current', $result));

    return $connection_edges_forward;
  }

  public function getReverseEdges($id)
  {
    $qb = $this->getEntityManager()->createQueryBuilder()->select('f.follower')
                  ->from('Model\Follow', 'f')
                  ->where('f.following = :following')
                  ->setParameter("following", $id);
    $query = $qb->getQuery();
    $result = $query->getScalarResult();
    $connection_edges_reverse = array_map([$this, "getUser"], array_map('current', $result));

    return $connection_edges_reverse;
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
