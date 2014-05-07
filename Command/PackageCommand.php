<?php

/*
 * This file is part of the RednoseYuiBundle package.
 *
 * (c) RedNose <http://www.rednose.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rednose\YuiBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpKernel\Kernel;
use Rednose\YuiBundle\Builder\PackageBuilder;
use Rednose\YuiBundle\Builder\ConfigBuilder;

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
        $dir = sprintf('%s/../web/%s', $this->getContainer()->get('kernel')->getRootDir(), ConfigBuilder::YUI_DIR);

        $output->writeln(sprintf('Building the YUI production packages'));

        $name = 'test';
        print  $this->getPackageBuilder()->package($name);
        $path = sprintf('%s/%s.js', $dir, $name);

        $output->writeln(sprintf('<comment>%s</comment> <info>[file+]</info> %s', date('H:i:s'), $path));

        if (false === @file_put_contents($path, $this->getPackageBuilder()->package($name))) {
            throw new \RuntimeException('Unable to write file '.$path);
        }
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
