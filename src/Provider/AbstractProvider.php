<?php

namespace Nucleus\Provider;

abstract class AbstractProvider
{
  //protected $app;

  protected $entityManager;

  public function setEntityManager( $manager )
  {
    $this->entityManager = $manager;
  }

  public function getEntityManager()
  {
    return $this->entityManager;
  }
}
