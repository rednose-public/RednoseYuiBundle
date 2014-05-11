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

        $container->setParameter('rednose_yui.version', $config['version']);
        $container->setParameter('rednose_yui.gallery', $config['gallery']);
        $container->setParameter('rednose_yui.root', $config['combo_root']);
        $container->setParameter('rednose_yui.assets', $config['assets']);
        $container->setParameter('rednose_yui.groups', $config['combo_groups']);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $serviceFiles = array('twig', 'services');

        foreach ($serviceFiles as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'rednose_yui';
    }
}
