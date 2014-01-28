<?php

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

        $serviceFiles = array('services');

        foreach ($serviceFiles as $basename) {
            $loader->load(sprintf('%s.xml', $basename));
        }

        if (!empty($config['yogi_bin'])) {
            $this->loadYogi($config['yogi_bin'], $container);
        }

        if (!empty($config['loader_bin'])) {
            $this->loadYuiLoader($config['loader_bin'], $container);
        }

        if (!empty($config['groups'])) {
            $this->loadConfigBuilder($config['groups'], $container);
        }
    }

    /**
     * @param string           $path
     * @param ContainerBuilder $container
     */
    private function loadYogi($path, ContainerBuilder $container)
    {
        $classParam = '%rednose_yui.driver.yogi.class%';

        $definition = new Definition($classParam, array($path));

        $container->setDefinition('rednose_yui.driver.yogi', $definition);
    }

    /**
     * @param string           $path
     * @param ContainerBuilder $container
     */
    private function loadYuiLoader($path, ContainerBuilder $container)
    {
        $classParam = '%rednose_yui.driver.yui_loader.class%';

        $definition = new Definition($classParam, array($path));

        $container->setDefinition('rednose_yui.driver.yui_loader', $definition);
    }

    /**
     * @param array            $config
     * @param ContainerBuilder $container
     */
    private function loadConfigBuilder(array $config, ContainerBuilder $container)
    {
        $groups = array();

        foreach ($config as $group) {
            $groups[$group['name']] = $group['root'];
        }

        $container->getDefinition('rednose_yui.builder.config_builder')->replaceArgument(3, $groups);
    }

    /**
     * {@inheritDoc}
     */
    public function getAlias()
    {
        return 'rednose_yui';
    }
}
