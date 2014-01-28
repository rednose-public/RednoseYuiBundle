<?php

namespace Rednose\YuiBundle\Command;

use Rednose\YuiBundle\Controller\YuiController;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;
use Rednose\YuiBundle\Builder\PackageBuilder;

class PackageCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('rednose:yui:package')
            ->setDescription('Builds all configured production packages.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        print $this->getPackageBuilder()->package('test');
//        $fs         = new Filesystem();
//        $container  = $this->getContainer();
//        $baseDir    = $container->get('kernel')->getRootDir() . '/../';
//        $targetDir  = 'web/bundles/rednoseyui';
//        $controller = new YuiController;
//
//        $fs->mkdir($targetDir);
//        $controller->setContainer($container);
//
//        $bundles = $container->getParameter('rednose_yui.bundles');
//
//        foreach ($bundles as $bundle) {
//            $name = $bundle['name'];
//
//            $output->writeln(sprintf('Deploying YUI module-bundle <comment>%s</comment> into <comment>%s</comment>', $name, $targetDir));
//            file_put_contents($baseDir.$targetDir.'/'.$name.'.js', $controller->packageAction($name)->getContent());
//        }
    }

    /**
     * @return Kernel
     */
    protected function getKernel()
    {
        return $this->getContainer()->get('kernel');
    }

    /**
     * @return PackageBuilder
     */
    protected function getPackageBuilder()
    {
        return $this->getContainer()->get('rednose_yui.builder.package_builder');
    }
}
