<?php

namespace Model;

/**
 * @Entity @Table(name="follow")
 */
class Follow
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  protected $id;

  /**
   * @Column(type="integer")
   */
   protected $follower;

   /**
    * @Column(type="integer")
  */
  protected $following;

  /**
   * @Column(type="decimal")
   */
   protected $affinity;

   public function getId()
   {
     return $this->id;
   }

   public function getFollower()
   {
     return $this->follower;
   }

   public function getFollowing()
   {
     return $this->following;
   }

   public function getAffinity()
   {
     return $this->affinity;
   }

   public function setFollower( $follower )
   {
     $this->follower = $follower;
   }

   public function setFollowing( $following )
   {
     $this->following = $following;
   }

   public function setAffinity( $affinity )
   {
     $this->affinity = $affinity;
   }
}
