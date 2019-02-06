<?php

namespace Symfony\Component\PropertyInfo\Extractor;

use Symfony\Component\PropertyInfo\ConstructorArgumentTypeExtractorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;

/**
 * Extracts the constructor argument type using ConstructorArgumentTypeExtractorInterface implementations
 *
 * @author Dmitrii Poddubnyi <dpoddubny@gmail.com>
 */
class ConstructorExtractor implements PropertyTypeExtractorInterface
{
    /** @var ConstructorArgumentTypeExtractorInterface[] */
    private $extractors;

    /**
     * @param ConstructorArgumentTypeExtractorInterface[] $extractors
     */
    public function __construct(array $extractors)
    {
        $this->extractors = $extractors;
    }

    /**
     * {@inheritdoc}
     */
    public function getTypes($class, $property, array $context = [])
    {
        foreach ($this->extractors as $extractor) {
            $value = $extractor->getTypesFromConstructor($class, $property);
            if (null !== $value) {
                return $value;
            }
        }

        return null;
    }
}
