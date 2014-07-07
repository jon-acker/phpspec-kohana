<?php

namespace PhpSpec\Kohana\Locator;

use PhpSpec\Locator\ResourceInterface;
use PhpSpec\Locator\ResourceLocatorInterface;
use PhpSpec\Util\Filesystem;

class PSR0Locator implements ResourceLocatorInterface
{
    /**
     * @var string
     */
    private $srcNamespace;

    /**
     * @var string
     */
    private $specSubNamespace;

    /**
     * @var string
     */
    private $srcPath;

    /**
     * @var array
     */
    private $specPath;

    /**
     * @var Filesystem
     */
    private $filesystem;

    /**
     * @var ResourceFactory
     */
    private $resourceFactory;

    /**
     * @param string          $srcNamespace
     * @param string          $specSubNamespace
     * @param string          $srcPath
     * @param array           $specPaths
     * @param Filesystem      $filesystem
     */
    public function __construct($srcNamespace = '', $specSubNamespace = 'Spec', $srcPath, $specPath, Filesystem $filesystem = null)
    {
        $this->srcNamespace = $srcNamespace;
        $this->specSubNamespace = $specSubNamespace;
        $this->srcPath = rtrim(realpath($srcPath), DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;
        $this->specPath = $specPath;
        $this->filesystem = $filesystem ?: new Filesystem();
        $this->srcPath = $srcPath;
    }


    /**
     * @return ResourceInterface[]
     */
    public function getAllResources()
    {
        $fullSpecPath = rtrim(realpath(str_replace(array('\\', '/'), DIRECTORY_SEPARATOR, $this->specPath)), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $resources = array();

        foreach ($this->filesystem->findPhpFilesIn($fullSpecPath) as $file) {

            $specFile = $file->getRealPath();
            $resources[] = $this->createResourceFromSpecFile($specFile, $fullSpecPath);
        }

        return $resources;
    }

    /**
     * @param string $query
     *
     * @return boolean
     */
    public function supportsQuery($query)
    {
        // TODO: Implement supportsQuery() method.
    }

    /**
     * @param string $query
     *
     * @return ResourceInterface[]
     */
    public function findResources($query)
    {
        echo 'find'; var_dump($query);

        // TODO: Implement findResources() method.
    }

    /**
     * @param string $classname
     *
     * @return boolean
     */
    public function supportsClass($classname)
    {
        $supports = preg_match('/^(([a-zA-Z0-9]+)_?)+$/', $classname);

        return false;
    }

    /**
     * @param string $classname
     *
     * @return ResourceInterface|null
     */
    public function createResource($classname)
    {
        $parts = preg_split('/_/', $classname);

        $parts = array_map(function($part) {
            return lcfirst($part);
        }, $parts);

        return new PSR0Resource($parts, $this);
    }

    /**
     * @return integer
     */
    public function getPriority()
    {
        return 10;
    }

    public function getSrcPath()
    {
        return $this->srcPath;
    }

    public function getSpecPath()
    {

        return $this->specPath;
    }

    public function getSpecNamespace()
    {
        return $this->specSubNamespace;
    }

    /**
     * @param string $path
     *
     * @return PSR0Resource|null
     */
    private function createResourceFromSpecFile($specPath, $fullSpecPath)
    {
        $relativePath = substr($specPath, strlen($fullSpecPath), -4);
        $relativePath = str_replace('Spec', '', $relativePath);

        $class = implode('_', array_map(function($part) {
            return ucfirst($part);
        }, preg_split('/\//', $relativePath)));

        return $this->createResource($class);
    }
}