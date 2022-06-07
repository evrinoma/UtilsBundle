<?php

namespace Evrinoma\UtilsBundle\PreChecker;

use Evrinoma\DtoBundle\Dto\DtoInterface;

abstract class AbstractPreChecker
{

    abstract public function check(DtoInterface $dto): bool;

}