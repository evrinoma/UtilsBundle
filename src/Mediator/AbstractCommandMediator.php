<?php

namespace Evinoma\UtilsBundle\Mediator;

use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractCommandMediator
{
    abstract protected function onUpdate(DtoInterface $dto, $entity);

    abstract protected function onDelete(DtoInterface $dto, $entity): void;

    abstract protected function onCreate(DtoInterface $dto, $entity);
}