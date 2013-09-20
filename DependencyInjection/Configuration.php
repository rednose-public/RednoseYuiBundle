<?php

namespace Rednose\YuiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rednose_yui');

        $rootNode
            ->children()
                ->arrayNode('groups')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('name')->isRequired()->end()
                            ->scalarNode('root')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
