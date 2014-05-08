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
use Symfony\Component\Console\Output\OutputInterface;

class InstallCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('rednose:yui:install')
            ->setDefinition(array(
                new InputArgument('target', InputArgument::OPTIONAL, 'The target directory', 'web'),
            ))
            ->setDescription('Installs the YUI assets under a public web directory.');
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $config = array(
            array('name' => 'rednose-ui', 'dir' => 'vendor/rednose/rednose-ui')
        );

        $targetArg = rtrim($input->getArgument('target'), '/');

        if (!is_dir($targetArg)) {
            throw new \InvalidArgumentException(sprintf('The target directory "%s" does not exist.', $input->getArgument('target')));
        }

        if (!function_exists('symlink') && $input->getOption('symlink')) {
            throw new \InvalidArgumentException('The symlink() function is not available on your system..');
        }

        $filesystem = $this->getContainer()->get('filesystem');

        $yuiDir = $targetArg.'/yui/';
        $filesystem->mkdir($yuiDir, 0777);

        $output->writeln("Installing YUI assets");

        foreach ($config as $package) {
            $targetDir = $yuiDir.$package['name'];
            $originDir = $this->getContainer()->get('kernel')->getRootDir().'/../'.$package['dir'];

            $output->writeln(sprintf('Installing YUI assets for <comment>%s</comment> into <comment>%s</comment>', $package['name'], $targetDir));

            $filesystem->remove($targetDir);

            $filesystem->symlink($originDir, $targetDir);
        }
    }
}
