<?php

namespace Acme\AdminBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('acme_admin')
            ->children()
                ->scalarNode('loader_class')
                    ->defaultValue('Acme\DemoBundle\Asset\Loader\ArrayLoader')
                    ->end()
                ->scalarNode('loader_method')->defaultValue('fetch')->end()
                ->booleanNode('extra_value')->defaultValue(true)->end()
                ->arrayNode('filters')
                    ->children()
                        ->scalarNode('filterOne')->end()
                        ->scalarNode('filterTwo')->end()
                    ->end()
                ->end()
                ->scalarNode('path')
                    ->defaultValue('Acme\DemoBundle\Entity')
                    ->end()
                ->scalarNode('schema')
                    ->defaultValue('auto')
                    ->end()                
            ->end()
        ;
        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }
}
