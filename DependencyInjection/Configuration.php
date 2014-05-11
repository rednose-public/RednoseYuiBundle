<?php

/*
 * This file is part of the RednoseYuiBundle package.
 *
 * (c) RedNose <http://www.rednose.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rednose\YuiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('rednose_yui', 'array');

        $this->addBaseSection($rootNode);
        $this->addAssetsSection($rootNode);
        $this->addGroupsSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addBaseSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('version')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultValue('3.16.0')
                ->end()
                ->scalarNode('gallery')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultValue('2014.04.02-20-01')
                ->end()
                ->scalarNode('combo_root')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
            ->end();
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addAssetsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('assets')
                    // Don't normalize keys as Symfony (incorrectly) converts hyphens to underscores by default.
                    ->normalizeKeys(false)
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                ->end()
            ->end();
    }

    /**
     * @param ArrayNodeDefinition $node
     */
    private function addGroupsSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('combo_groups')
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')->end()
                ->end()
            ->end();
    }
}
