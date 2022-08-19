<?php

namespace Evrinoma\UtilsBundle\Persistence;

use Evrinoma\FetchBundle\Handler\HandlerInterface;

interface ManagerRegistryInterface
{
    public function getManager(string $handlerName, string $descriptionName): HandlerInterface;
}