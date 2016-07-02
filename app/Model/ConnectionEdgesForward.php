<?php

namespace Model;

/**
 * @Entity @Table(name="connection_edges_forward")
 */
class ConnectionEdgesForward
{
  /** @Id @Column(type="integer") @GeneratedValue **/
  private $id;

  /**
   * @Column(type="integer")
   */
   private $from;

   /**
    * @Column(type="integer")
  */
  private $to;

  /**
   * @Column(type="decimal")
   */
   private $affinity;

   public function getId()
   {
     return $this->id;
   }

   public function getFrom()
   {
     return $this->from;
   }

   public function getTo()
   {
     return $this->to;
   }

   public function getAffinity()
   {
     return $this->affinity;
   }

   public function setFrom( $from )
   {
     $this->from = $from;
   }

   public function setTo( $to )
   {
     $this->to = $to;
   }

   public function setAffinity( $affinity )
   {
     $this->affinity = $affinity;
   }
}
