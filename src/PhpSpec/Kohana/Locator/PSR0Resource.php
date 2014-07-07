<?php

namespace PhpSpec\Kohana\Locator;

use PhpSpec\Locator\ResourceInterface;

class PSR0Resource implements ResourceInterface
{
    private $parts;

    private $srcPath;

    private $specPath;

    private $specNamespace;

    public function __construct(array $namespaceParts, PSR0Locator $locator)
    {
        $this->parts   = $namespaceParts;
        $this->srcPath = $locator->getSrcPath();
        $this->specPath = $locator->getSpecPath();
        $this->specNamespace = $locator->getSpecNamespace();
    }

    public function getName()
    {
        return $this->ucClass($this->parts);
    }

    public function getSpecName()
    {
        return $this->getName() . 'Spec';
    }

    public function getSrcFilename()
    {
        return $this->srcPath . implode(DIRECTORY_SEPARATOR, $this->parts) . '.php';
    }

    public function getSrcNamespace()
    {
        return '';
    }

    public function getSrcClassname()
    {
        return $this->ucClass($this->parts);
    }

    public function getSpecFilename()
    {
        return $this->specPath . implode(DIRECTORY_SEPARATOR, $this->parts) . 'Spec.php';
    }

    public function getSpecNamespace()
    {
        return $this->specNamespace;
    }

    public function getSpecClassname()
    {
        return $this->ucClass($this->parts).'Spec';
    }

    /**
     * @param array $parts
     *
     * @return string
     */
    private function ucClass($parts)
    {
        return implode('_', array_map(function ($part) {
            return ucfirst($part);
        }, $parts));
    }
}