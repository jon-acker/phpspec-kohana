<?php

namespace PhpSpec\Kohana\Locator;

use PhpSpec\Locator\ResourceInterface;

class PSR0Resource implements ResourceInterface
{
    /**
     * @var array Namespace parts
     */
    private $parts;

    /**
     * @var PSR0Locator
     */
    private $locator;

    /**
     * @var string
     */
    private $specifiedClass;


    /**
     * @param array $namespaceParts
     * @param PSR0Locator $locator
     * @param string $specifiedClass
     */
    public function __construct(array $namespaceParts, PSR0Locator $locator, $specifiedClass)
    {
        $this->parts   = $namespaceParts;
        $this->locator = $locator;
        $this->specifiedClass = $specifiedClass;
    }

    public function getName()
    {
        return $this->specifiedClass;
    }

    public function getSpecName()
    {
        return $this->getName() . 'Spec';
    }

    public function getSrcFilename()
    {
        return $this->locator->getSrcPath() . implode(DIRECTORY_SEPARATOR, $this->parts) . '.php';
    }

    public function getSrcNamespace()
    {
        return '';
    }

    public function getSrcClassname()
    {
        return $this->specifiedClass;
    }

    public function getSpecFilename()
    {
        return $this->locator->getSpecPath() . implode(DIRECTORY_SEPARATOR, $this->parts) . 'Spec.php';
    }

    public function getSpecNamespace()
    {
        return $this->locator->getSpecNamespace();
    }

    public function getSpecClassname()
    {
        return $this->specifiedClass.'Spec';
    }
}