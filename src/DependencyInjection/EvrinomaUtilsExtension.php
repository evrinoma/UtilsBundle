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
use Evrinoma\UtilsBundle\Handler\BaseHandler;
use Evrinoma\UtilsBundle\Handler\HandlerInterface;
use Evrinoma\UtilsBundle\Mapping\MetadataManager;
use Evrinoma\UtilsBundle\Mapping\MetadataManagerInterface;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistry;
use Evrinoma\UtilsBundle\Persistence\ManagerRegistryInterface;
use Evrinoma\UtilsBundle\Serialize\SerializerInterface;
use Evrinoma\UtilsBundle\Serialize\Symfony\SerializerSymfony;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Alias;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\DependencyInjection\Reference;

class EvrinomaUtilsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);

        $metadataManager = new Definition(MetadataManager::class);
        $metadataManager->setArgument(0, $container->getParameterBag()->get('kernel.cache_dir'));
        $metadataManager->setArgument(1, new Reference('annotations.reader'));
        $metadataManager->setPublic(true);
        $alias = new Alias('evrinoma.utils.mapping.metadata_manager');
        $container->addDefinitions(['evrinoma.utils.mapping.metadata_manager' => $metadataManager]);
        $container->addAliases([MetadataManagerInterface::class => $alias]);

        $managerRegistry = new Definition(ManagerRegistry::class);
        $managerRegistry->setPublic(true);
        $alias = new Alias('evrinoma.utils.persistence.manager_registry');
        $container->addDefinitions(['evrinoma.utils.persistence.manager_registry' => $managerRegistry]);
        $container->addAliases([ManagerRegistryInterface::class => $alias]);
        $managerRegistry->setArgument(0, $metadataManager);

        $baseHandler = new Definition(BaseHandler::class);
        $baseHandler->setPublic(true);
        $alias = new Alias(BaseHandler::class);
        $container->addDefinitions([BaseHandler::class => $baseHandler]);
        $container->addAliases([HandlerInterface::class => $alias]);
        $container->addAliases(['evrinoma.utils.handler.base_handler' => $alias]);

        $baseSerializer = new Definition(SerializerSymfony::class);
        $baseSerializer->setPublic(true);
        $alias = new Alias(SerializerSymfony::class);
        $container->addDefinitions([SerializerSymfony::class => $baseSerializer]);
        $container->addAliases([SerializerInterface::class => $alias]);
        $container->addAliases(['evrinoma.utils.serializer' => $alias]);
    }

    public function getAlias()
    {
        return EvrinomaUtilsBundle::UTILS_BUNDLE;
    }
}
