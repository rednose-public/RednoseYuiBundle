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

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

class ConfigBuilder
{
    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $gallery;

    /**
     * @var string
     */
    protected $root;

    /**
     * @var array
     */
    protected $groups;

    /**
     * @var array
     */
    protected $roots;

    /**
     * Constructor.
     *
     * @param Kernel          $kernel
     * @param EngineInterface $templating
     * @param string          $version
     * @param string          $gallery
     * @param string          $root
     * @param array           $groups
     * @param array           $roots
     */
    public function __construct(Kernel $kernel, EngineInterface $templating, $version, $gallery, $root, array $groups = array(), array $roots = array())
    {
        $this->kernel     = $kernel;
        $this->templating = $templating;
        $this->version    = $version;
        $this->root       = $root;
        $this->gallery    = $gallery;
        $this->groups     = $groups;
        $this->roots      = $roots;
    }

    /**
     * @param string $baseUrl
     *
     * @return string
     */
    public function getConfig($baseUrl)
    {
        return sprintf('YUI_config = %s;', $this->getJson($baseUrl));
    }

    /**
     * @param string $baseUrl
     *
     * @return string
     */
    public function getJson($baseUrl)
    {
        return $this->templating->render('RednoseYuiBundle:Yui:config.json.twig', array(
            'baseUrl' => $baseUrl,
            'version' => $this->version,
            'root'    => $this->root,
            'gallery' => $this->gallery,
            'groups'  => $this->groups,
            'roots'   => $this->roots
        ));
    }
}
