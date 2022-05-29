<?php

namespace Evrinoma\UtilsBundle\PreChecker;

use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractPreChecker
{
//region SECTION: Public
    abstract public function check(DtoInterface $dto): bool;
//endregion Public
}