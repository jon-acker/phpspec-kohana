<?php


namespace PhpSpec\Kohana\Generator;


use PhpSpec\CodeGenerator\Generator\ClassGenerator;
use PhpSpec\Kohana\Locator\PSR0Resource;
use PhpSpec\Locator\ResourceInterface;

class KohanaCodeGenerator extends ClassGenerator
{

    /**
     * @param ResourceInterface $resource
     * @param string $generation
     * @param array $data
     *
     * @return mixed
     */
    public function supports(ResourceInterface $resource, $generation, array $data)
    {
        return 'class' === $generation && $resource instanceof PSR0Resource;
    }

    /**
     * @return mixed
     */
    public function getPriority()
    {
        return 10;
    }

    /**
     * @return string
     */
    protected function getTemplate()
    {
        return file_get_contents(__FILE__, null, null, __COMPILER_HALT_OFFSET__);
    }
}
__halt_compiler();<?php

class %name%
{
}
