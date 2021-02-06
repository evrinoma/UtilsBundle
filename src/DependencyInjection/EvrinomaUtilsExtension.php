<?php


namespace Evrinoma\UtilsBundle\DependencyInjection;

use Evrinoma\UtilsBundle\EvrinomaUtilsBundle;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;


class EvrinomaUtilsExtension extends Extension
{
//region SECTION: Public
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration   = $this->getConfiguration($configs, $container);
        $config          = $this->processConfiguration($configuration, $configs);
        $this->container = $container;
        $ldapServers        = $config['ldap_servers'];
        if ($ldapServers) {
            $definition = $this->container->getDefinition('evrinoma.security.provider.ldap');
            $definition->addMethodCall('setServers', [$ldapServers]);
        }
    }
//endregion Public

//region SECTION: Getters/Setters
    public function getAlias()
    {
        return EvrinomaUtilsBundle::UTILS_BUNDLE;
    }
//endregion Getters/Setters
}