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

namespace Evrinoma\UtilsBundle\DependencyInjection;

use Evrinoma\UtilsBundle\EvrinomaUtilsBundle;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistry;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class EvrinomaUtilsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $fetchManager = new Definition(ManagerRegistry::class);
        $fetchManager->setPublic(true);
        $alias = new Alias('evrinoma.fetch.manager.fetch');
        $container->addDefinitions(['evrinoma.fetch.manager.fetch' => $fetchManager]);
        $container->addAliases([ManagerRegistryInterface::class => $alias]);
    }

    public function getAlias()
    {
        return EvrinomaUtilsBundle::UTILS_BUNDLE;
    }
}
