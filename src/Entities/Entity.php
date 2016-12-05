<?php
declare (strict_types = 1);

namespace Src\Entities;

use Doctrine\ORM\EntityManager;

abstract class Entity
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}