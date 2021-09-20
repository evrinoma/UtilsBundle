<?php

namespace Evrinoma\UtilsBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;

interface MapEntityInterface
{
    /**
     * @param ContainerBuilder $container
     *
     * @return MapEntityInterface
     */
    public function setContainer(ContainerBuilder $container): MapEntityInterface;
}
