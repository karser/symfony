<?php

namespace Symfony\Component\PropertyInfo\DependencyInjection;

use Symfony\Component\DependencyInjection\Argument\IteratorArgument;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Compiler\PriorityTaggedServiceTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Adds extractors to the property_info.constructor_extractor service.
 *
 * @author Dmitrii Poddubnyi <dpoddubny@gmail.com>
 */
class PropertyInfoConstructorPass implements CompilerPassInterface
{
    use PriorityTaggedServiceTrait;

    private $service;
    private $tag;

    public function __construct($service = 'property_info.constructor_extractor', $tag = 'property_info.constructor_extractor')
    {
        $this->service = $service;
        $this->tag = $tag;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition($this->service)) {
            return;
        }
        $definition = $container->getDefinition($this->service);

        $listExtractors = $this->findAndSortTaggedServices($this->tag, $container);
        $definition->replaceArgument(0, new IteratorArgument($listExtractors));
    }
}
