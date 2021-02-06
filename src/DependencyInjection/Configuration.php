<?php

namespace Evrinoma\UtilsBundle\DependencyInjection;

use Evrinoma\UtilsBundle\EvrinomaUtilsBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 *
 * @package Evrinoma\ProjectBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface
{
//region SECTION: Getters/Setters
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(EvrinomaUtilsBundle::UTILS_BUNDLE);
        $rootNode    = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->arrayNode('ldap_servers')
                    ->useAttributeAsKey('name')
                    ->normalizeKeys(false)
                    ->prototype('array')
                        ->prototype('array')
                            ->prototype('scalar')->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
//endregion Getters/Setters
}
