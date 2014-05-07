<?php

/*
 * This file is part of the RednoseYuiBundle package.
 *
 * (c) RedNose <http://www.rednose.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Rednose\YuiBundle\Driver;

use Symfony\Component\Process\Process;

/**
 * Yogi binary driver.
 */
class YogiDriver
{
    /**
     * @var string
     */
    protected $yogi;

    /*
     * Constructor.
     *
     * @param string $yogi
     */
    public function __construct($yogi)
    {
        $this->yogi = $yogi;
    }

    /**
     * @param string $path
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    public function getLoaderMetadata($path)
    {
        $jsFile    = sys_get_temp_dir().'/'.'yui3.js';
        $jsonFile  = sys_get_temp_dir().'/'.'yui3.json';
        $testsFile = sys_get_temp_dir().'/'.'load-tests.js';

        $process = new Process(sprintf('%s loader --yes --start %s -js %s -json %s -tests %s', $this->yogi, $path, $jsFile, $jsonFile, $testsFile));

        $process->run();

        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }

        $metadata = file_get_contents($jsonFile);

        unlink($jsFile);
        unlink($jsonFile);
        unlink($testsFile);

        return $metadata;
    }
}
