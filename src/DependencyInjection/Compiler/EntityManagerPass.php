<?php

declare(strict_types=1);

/*
 * This file is part of the package.
 *
 * (c) Nikolay Nikolaev <evrinoma@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Evrinoma\UtilsBundle\DependencyInjection\Compiler;

use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class EntityManagerPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(ManagerRegistryInterface::class)) {
            return;
        }

        $definition = $container->findDefinition(ManagerRegistryInterface::class);

        $taggedServices = $container->findTaggedServiceIds('evrinoma.utils.entity_manager');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('registerEntityManager', [new Reference($id)]);
        }
    }
}
