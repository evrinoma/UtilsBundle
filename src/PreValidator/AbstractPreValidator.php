<?php

namespace Evrinoma\UtilsBundle\PreValidator;

use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractPreValidator
{
    abstract protected function onPost(DtoInterface $dto): void;

    abstract protected function onPut(DtoInterface $dto): void;

    abstract protected function onDelete(DtoInterface $dto): void;
}