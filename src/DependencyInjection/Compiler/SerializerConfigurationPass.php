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

use Evrinoma\UtilsBundle\Serialize\SerializerInterface;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SerializerConfigurationPass implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(SerializerInterface::class)) {
            return;
        }

        $definition = $container->findDefinition(SerializerInterface::class);

        $taggedServices = $container->findTaggedServiceIds('evrinoma.serializer');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addConfiguration', [new Reference($id)]);
        }
    }
}
