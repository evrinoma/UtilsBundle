<?php


namespace Evrinoma\UtilsBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

trait Helper
{
//region SECTION: Protected
    /**
     * @param ContainerBuilder $container
     * @param string           $className
     * @param string           $aliasName
     * @param                  $arguments
     * @param false            $public
     *
     * @return Definition
     */
    protected function addDefinition(ContainerBuilder $container,  string $className, string $aliasName, $arguments, $public = false): Definition
    {
        $definition = new Definition($className);
        $alias      = new Alias($aliasName);

        if ($public) {
            $definition->setPublic(true);
            $alias->setPublic(true);
        }
        $container->addDefinitions([$aliasName => $definition]);
        $container->addAliases([$className => $alias]);

        foreach ($arguments as $key => $argument) {
            $definition->setArgument($key, $argument);
        }

        return $definition;
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     * @param array            $map
     */
    protected function remapParameters(ContainerBuilder $container,array $config, array $map): void
    {
        foreach ($map as $name => $paramName) {
            if (array_key_exists($name, $config)) {
                $container->setParameter($paramName, $config[$name]);
            }
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param array            $config
     * @param array            $namespaces
     */
    protected function remapParametersNamespaces(ContainerBuilder $container, array $config, array $namespaces): void
    {
        foreach ($namespaces as $ns => $map) {
            if ($ns) {
                if (!array_key_exists($ns, $config)) {
                    continue;
                }
                $namespaceConfig = $config[$ns];
            } else {
                $namespaceConfig = $config;
            }
            if (is_array($map)) {
                $this->remapParameters($container, $namespaceConfig, $map);
            } else {
                foreach ($namespaceConfig as $name => $value) {
                    $container->setParameter(sprintf($map, $name), $value);
                }
            }
        }
    }

    /**
     * @param string $class
     *
     * @return string
     * @throws \ReflectionException
     */
    protected function toShortName(string $class)
    {
        return (new \ReflectionClass($class))->getShortName();
    }
//endregion Protected
}