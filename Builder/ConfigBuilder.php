<?php

/*
 * This file is part of the RednoseYuiBundle package.
 *
 * (c) RedNose <http://www.rednose.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rednose\YuiBundle\Builder;

use Rednose\YuiBundle\Driver\YogiDriver;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\DirectoryResource;

class ConfigBuilder
{
    const YUI_DIR = 'yui';

    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var array
     */
    protected $groups;

    /**
     * Constructor.
     *
     * @param Kernel          $kernel
     * @param EngineInterface $templating
     * @param array           $groups
     *
     * @throws \RuntimeException
     */
    public function __construct(Kernel $kernel, EngineInterface $templating, array $groups, array $packages)
    {
        $this->kernel     = $kernel;
        $this->groups     = $groups;
        $this->templating = $templating;
        $this->packages   = $packages;
    }

    /**
     * @param string $baseUrl
     * @param bool $local
     *
     * @return string
     */
    public function getConfig($baseUrl, $local = false)
    {
        $groups = array();

        foreach ($this->groups as $name => $root) {
            $groups[] = $name;
        }

        return sprintf('YUI_config = %s;', $this->getJson($groups, $local, $baseUrl));
    }

    /**
     * @param array  $groups
     * @param bool   $local
     * @param string $baseUrl
     *
     * @return string
     */
    public function getJson($groups, $local, $baseUrl = null)
    {
        return $this->templating->render('RednoseYuiBundle:Yui:config.json.twig', array(
            'groups'  => $groups,
            'local'   => $local,
            'baseUrl' => $baseUrl,
            'base'    => sprintf('%s/../web/', $this->kernel->getRootDir()),
        ));
    }

    /**
     * @return array
     */
    public function getConfigGroups()
    {
        return $this->groups;
    }

    public function getPackages()
    {
        return $this->packages;
    }
//
//    /**
//     * @return array
//     */
//    protected function getGroups()
//    {
//        $groups = array();
//
//        foreach ($this->groups as $name => $root) {
//            $path = sprintf('%s/../web/%s/src', $this->kernel->getRootDir(), $root);
//
//            $groups[] = array(
//                'name'     => $name,
//                'root'     => $root,
//                'metadata' => $this->yogi->getLoaderMetadata($path),
//            );
//        }
//
//        return $groups;
//    }
//
//    /**
//     * @return string
//     */
//    private function getFilename()
//    {
//        if ($this->kernel->getEnvironment() === 'dev') {
//            return 'config_dev.js';
//        }
//
//        return 'config.js';
//    }
}
