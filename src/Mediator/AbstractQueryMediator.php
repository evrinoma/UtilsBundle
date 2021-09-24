<?php

namespace Evrinoma\UtilsBundle\Mediator;

use Doctrine\ORM\QueryBuilder;
use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractQueryMediator
{
//region SECTION: Fields
    protected static string $alias = '';
//endregion Fields

//region SECTION: Public
    abstract protected function createQuery(DtoInterface $dto, QueryBuilder $builder): void;

    public function alias(): string
    {
        return static::$alias;
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getResult(DtoInterface $dto, QueryBuilder $builder): array
    {
        return $builder->getQuery()->getResult();
    }
//endregion Getters/Setters
}