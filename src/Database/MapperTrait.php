<?php

namespace Nucleus\Database;

use Doctrine\ORM\EntityManager;

trait MapperTrait
{
  private $entityManager;
  private $queryBuilder;

  public function getEntityManager()
  {
    return $this->entityManager;
  }

  public function getQueryBuilder()
  {
    if(!($this->queryBuilder instanceof EntityManager ))
      $this->queryBuilder = $this->getEntityManager()->createQueryBuilder();

    return $this->queryBuilder;
  }
}
