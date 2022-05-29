<?php

namespace Evrinoma\UtilsBundle\PreValidator;

use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractPreValidator
{
    abstract protected function onUpdate(DtoInterface $dto);

    abstract protected function onDelete(DtoInterface $dto): void;

    abstract protected function onCreate(DtoInterface $dto);
}