<?php

namespace Rednose\YuiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Config\ConfigCache;
use Symfony\Component\Config\Resource\FileResource;

class YuiController extends Controller
{
	const YUI3_JSON_DIR    = 'src/loader/js';
	const YUI3_JSON_FILE   = 'yui3.json';

	const CACHE = false;

    public function configAction()
    {
    	if (self::CACHE === true) {
	        $cachePath = $this->get('kernel')->getRootDir().'/cache/config.js';

	        $configCache = new ConfigCache($cachePath, true);

	        if (!$configCache->isFresh()) {
	            // fill this with an array of 'users.yml' file paths
	            $yamlUserFiles = array();

	            $resources = array();

	            foreach ($yamlUserFiles as $yamlUserFile) {
	                // see the previous article "Loading resources" to
	                // see where $delegatingLoader comes from
	                $delegatingLoader->load($yamlUserFile);
	                $resources[] = new FileResource($yamlUserFile);
	            }

	            $configCache->write($this->getContent(), $resources);
	        }

	        return new Response(file_get_contents($cachePath), 200, array(
	            'Content-Type' => 'application/javascript'
	        ));
    	}

        return new Response($this->getContent(), 200, array(
            'Content-Type' => 'application/javascript'
        ));
    }

    protected function getContent()
    {
	   	$config = $this->container->getParameter('rednose_yui.groups');

	   	$groups = array();

	   	foreach ($config as $c) {
   			$name = $c['name'];
   			$root = $c['root'];

            // Look for yui3.json loader metadata file.
            $locator = new FileLocator;

            $metadata = '';

            try {
                $path = $locator->locate(self::YUI3_JSON_FILE, $this->get('kernel')->getRootDir().'/../web/'.$root.'/'.self::YUI3_JSON_DIR, true);
                $metadata = file_get_contents($path);
            } catch (\Exception $e) {}

	   		$groups[] = array(
				'name'     => $c['name'],
				'root'     => $c['root'],
				'metadata' => $metadata,
   			);
	   	}

        return $this->get('templating')->render('RednoseYuiBundle:Yui:config.js.twig', array(
            'groups' => $groups
        ));
    }
}
