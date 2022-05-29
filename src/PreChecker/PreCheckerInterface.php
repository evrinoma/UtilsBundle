<?php

namespace Evrinoma\UtilsBundle\PreChecker;

use Evrinoma\DtoBundle\Dto\DtoInterface;

interface PreCheckerInterface
{
//region SECTION: Public
    public function check(DtoInterface $dto): bool;
//endregion Public
}