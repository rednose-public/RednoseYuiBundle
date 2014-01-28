<?php

namespace Rednose\YuiBundle\Builder;

use Rednose\YuiBundle\Driver\YogiDriver;
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\DirectoryResource;

class ConfigBuilder
{
    /**
     * @var Kernel
     */
    protected $kernel;

    /**
     * @var YogiDriver
     */
    protected $yogi;

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
     * @param YogiDriver      $yogi
     * @param EngineInterface $templating
     * @param array           $groups
     */
    public function __construct(Kernel $kernel, YogiDriver $yogi, EngineInterface $templating, array $groups)
    {
        $this->kernel     = $kernel;
        $this->yogi       = $yogi;
        $this->groups     = $groups;
        $this->templating = $templating;
        $this->path       = sprintf('%s/cache/%s/rednose_yui/config.js', $kernel->getRootDir(), $kernel->getEnvironment());
    }

    /**
     * @param string $baseUrl
     * @param bool   $local
     * @param bool   $raw
     *
     * @return string
     */
    public function getConfig($baseUrl = null, $local = false, $raw = false)
    {
        if ($raw) {
            return $this->getJson($this->getGroups(), $local, $baseUrl);
        }

        $cache = new ConfigCache($this->path, true);

        if (!$cache->isFresh()) {
            $this->buildConfig($baseUrl, $local);
        }

        // TODO: Return URL for faster loading
        return file_get_contents($cache);
    }

    /**
     * @param string $baseUrl
     * @param bool   $local
     *
     * @return string
     */
    public function buildConfig($baseUrl = null, $local = false)
    {
        $cache     = new ConfigCache($this->path, true);
        $groups    = $this->getGroups();
        $resources = array();

        foreach ($groups as $group) {
            $path = sprintf('%s/../web/%s', $this->kernel->getRootDir(), $group['root']);

            $resources[] = new DirectoryResource($path.'/src', '/\.json$/');
        }

        $cache->write(sprintf('YUI_config = %s;', $this->getJson($groups, $local, $baseUrl)), $resources);
    }

    /**
     * @param array  $groups
     * @param bool   $local
     * @param string $baseUrl
     *
     * @return string
     */
    protected function getJson($groups, $local, $baseUrl)
    {
        return $this->templating->render('RednoseYuiBundle:Yui:config.json.twig', array(
            'groups'  => $groups,
            'local'   => $local,
            'baseUrl' => $baseUrl,
        ));
    }

    /**
     * @return array
     */
    protected function getGroups()
    {
        $groups = array();

        foreach ($this->groups as $name => $root) {
            $path = sprintf('%s/../web/%s/src', $this->kernel->getRootDir(), $root);

            $groups[] = array(
                'name'     => $name,
                'root'     => $root,
                'metadata' => $this->yogi->getLoaderMetadata($path),
            );
        }

        return $groups;
    }
}
