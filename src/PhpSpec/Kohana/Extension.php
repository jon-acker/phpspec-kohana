<?php

namespace PhpSpec\Kohana;

use PhpSpec\Extension\ExtensionInterface;
use PhpSpec\Kohana\Generator\KohanaCodeGenerator;
use PhpSpec\Kohana\Generator\KohanaGenerator;
use PhpSpec\Kohana\Generator\KohanaSpecificationGenerator;
use PhpSpec\Kohana\Locator\PSR0Locator;
use PhpSpec\ServiceContainer;

class Extension implements ExtensionInterface
{

    /**
     * @param ServiceContainer $container
     */
    public function load(ServiceContainer $container)
    {

        $container->addConfigurator(function($c) {
            $c->setShared('locator.locators.kohana_locator',
                function($c) {
                    $applicationRoot = $c->getParam('application_root');
                    return new PSR0Locator(null, null, $applicationRoot . '/classes/', $applicationRoot . '/spec/');
                }
            );
        });

        $container->setShared('code_generator.generators.kohana_class', function ($c) {
            return new KohanaCodeGenerator(
                $c->get('console.io'),
                $c->get('code_generator.templates')
            );
        });

        $container->setShared('code_generator.generators.kohana_specification', function ($c) {
            return new KohanaSpecificationGenerator(
                $c->get('console.io'),
                $c->get('code_generator.templates')
            );
        });
    }
}