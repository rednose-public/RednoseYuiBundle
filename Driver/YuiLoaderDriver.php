<?php

namespace Rednose\YuiBundle\Driver;

use Symfony\Component\Process\Process;

/**
 * Binary driver for the YUI loader.
 */
class YuiLoaderDriver
{
    /**
     * @var string
     */
    protected $loader;

    /*
     * Constructor.
     *
     * @param string $path
     */
    public function __construct($loader)
    {
        $this->loader = $loader;
    }
}
