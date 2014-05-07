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

use Rednose\YuiBundle\Driver\YuiLoaderDriver;

class PackageBuilder
{
    /**
     * @var YuiLoaderDriver
     */
    protected $loader;

    /**
     * @var ConfigBuilder
     */
    protected $builder;

    /**
     * @var array
     */
    protected $bundles;

    /**
     * Constructor.
     *
     * @param YuiLoaderDriver $loader
     * @param ConfigBuilder   $builder
     * @param array           $bundles
     */
    public function __construct(YuiLoaderDriver $loader, ConfigBuilder $builder, array $bundles)
    {
        $this->loader  = $loader;
        $this->bundles = $bundles;
        $this->builder = $builder;
    }

    /**
     * @param  $name
     * @return string
     *
     * @throws \InvalidArgumentException
     */
    public function package($name)
    {
        if (!isset($this->bundles[$name])) {
            throw new \InvalidArgumentException('Package is not registered: '.$name);
        }

        return $this->loader->getPackage($this->bundles[$name], $this->builder->getRawJson());
    }
}
