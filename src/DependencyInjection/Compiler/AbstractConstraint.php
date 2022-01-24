<?php

namespace Evrinoma\UtilsBundle\DependencyInjection\Compiler;

use Evrinoma\UtilsBundle\Exception\ConstraintCannotBeCompiledException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;


abstract class AbstractConstraint
{
    protected static string $alias = '';
    protected static string $class = '';
    protected static string $methodCall = '';

    /**
     * @inheritDoc
     */
    public function process(ContainerBuilder $container)
    {
        if (static::$alias === '' || static::$class ==='' || static::$methodCall ==='') {
            throw new ConstraintCannotBeCompiledException();
        }

        if (!$container->has(static::$class)) {
            return;
        }

        $definition = $container->findDefinition(static::$class);

        $taggedServices = $container->findTaggedServiceIds(static::$alias);

        foreach ($taggedServices as $id => $tags) {
             $definition->addMethodCall(static::$methodCall, [new Reference($id)]);
        }
    }
}