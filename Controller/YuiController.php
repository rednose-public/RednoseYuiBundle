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
use Symfony\Component\Config\Resource\DirectoryResource;
use Symfony\Component\Process\Process;

/**
 * Provides a dynamically generated and cached YUI3 config file, containing
 * module metadata and group configuration.
 */
class YuiController extends Controller
{
	const YUI3_JSON_DIR   = 'src/loader/js';
	const YUI3_JSON_FILE  = 'yui3.json';

	const CACHE    = true;
	const GENERATE = true;

    /**
     * Returns a YUI3 config JavaScript file.
     *
     * @return Response
     */
    public function configAction()
    {
    	if (self::CACHE === true) {
	        $cachePath = $this->get('kernel')->getRootDir().'/cache/config.js';

	        $configCache = new ConfigCache($cachePath, true);

	        if (!$configCache->isFresh()) {
	            $resources = array();

			   	$config = $this->container->getParameter('rednose_yui.groups');

			   	foreach ($config as $c) {
			   		$root = $c['root'];
	                $path = $this->get('kernel')->getRootDir().'/../web/'.$root;

		            if (self::GENERATE === true) {
			            $resources[] = new DirectoryResource($path.'/src', '/\.json$/');
			        } else {
			            $resources[] = new FileResource($path.'/'.self::YUI3_JSON_DIR.'/'.YUI3_JSON_FILE);
			        }
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

    /**
     * Walks through all configured YUI3 dirs and either loads the yui3.json file
     * or generates the loader metadata.
     *
     * @return String YUI3 config object
     */
    protected function getContent()
    {
	   	$config = $this->container->getParameter('rednose_yui.groups');

	   	$groups = array();

	   	foreach ($config as $c) {
   			$name = $c['name'];
   			$root = $c['root'];

            $metadata = null;

            if (self::GENERATE === true) {
                $path = $this->get('kernel')->getRootDir().'/../web/'.$root.'/src';
                $yogi = $this->container->getParameter('rednose_yui.yogi_bin');

				$js    = sys_get_temp_dir().'/'.'yui3.js';
				$json  = sys_get_temp_dir().'/'.'yui3.json';
				$tests = sys_get_temp_dir().'/'.'load-tests.js';

				$process = new Process($yogi.' loader --yes --start '.$path.' -js '.$js.' -json '.$json.' -tests '.$tests);
				$process->run();

				if (!$process->isSuccessful()) {
				    throw new \RuntimeException($process->getErrorOutput());
				}

                $metadata = file_get_contents($json);

                unlink($js);
                unlink($json);
                unlink($tests);
            } else {
	            // Look for yui3.json loader metadata file.
	            $locator = new FileLocator;

	            try {
	                $path = $locator->locate(self::YUI3_JSON_FILE, $this->get('kernel')->getRootDir().'/../web/'.$root.'/'.self::YUI3_JSON_DIR, true);
	                $metadata = file_get_contents($path);
	            } catch (\Exception $e) {}
            }

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
