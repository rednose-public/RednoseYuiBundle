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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Definition;

class RednoseYuiExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $serviceFiles = array('twig', 'services');

        foreach ($serviceFiles as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }

        if (!empty($config['packages'])) {
            $this->loadPackages($config['packages'], $container);
        }

        if (!empty($config['groups'])) {
            $this->loadConfigBuilder($config['groups'], $container);
        }
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadPackages(array $config, ContainerBuilder $container)
    {
        $packages = array();

        foreach ($config as $package) {
            $packages[$package['name']] = $package['dir'];
        }

        $container->getDefinition('rednose_yui.builder.config_builder')->replaceArgument(3, $packages);
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadConfigBuilder(array $config, ContainerBuilder $container)
    {
        $groups = array();

        foreach ($config as $group) {
            $groups[$group['name']] = $group['name'];
        }

        $container->getDefinition('rednose_yui.builder.config_builder')->replaceArgument(2, $groups);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'rednose_yui';
    }
}
