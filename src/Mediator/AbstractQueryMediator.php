<?php

namespace Evrinoma\UtilsBundle\Mediator;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractQueryMediator
{

    protected static string $alias = '';



    abstract protected function createQuery(DtoInterface $dto, QueryBuilder $builder): void;

    public function alias(): string
    {
        return static::$alias;
    }



    public function getResult(DtoInterface $dto, QueryBuilder $builder): array
    {
        return $builder->getQuery()->getResult();
    }

}