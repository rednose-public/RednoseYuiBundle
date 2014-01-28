<?php

namespace Rednose\YuiBundle\Builder;

use Rednose\YuiBundle\Driver\YuiLoaderDriver;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class PackageBuilder
{
    const YUI_DIR = 'yui';

    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @var YuiLoaderDriver
     */
    protected $loader;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var array
     */
    protected $bundles;

    /**
     * Constructor.
     *
     * @param Kernel          $kernel
     * @param YuiLoaderDriver $loader
     * @param EngineInterface $templating
     * @param array           $bundles
     */
    public function __construct(Kernel $kernel, YuiLoaderDriver $loader, EngineInterface $templating, array $bundles)
    {
        $this->kernel     = $kernel;
        $this->loader     = $loader;
        $this->bundles    = $bundles;
        $this->templating = $templating;
        $this->path       = sprintf('%s/../web/%s', $kernel->getRootDir(), self::YUI_DIR);
    }

    public function package($name)
    {
        print $name;
    }
}
