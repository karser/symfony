<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\PropertyInfo\Tests;

use Symfony\Component\PropertyInfo\Extractor\ConstructorExtractor;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\PropertyInfo\Type;

/**
 * @author Kévin Dunglas <dunglas@gmail.com>
 */
class PropertyInfoExtractorTest extends AbstractPropertyInfoExtractorTest
{
    /**
     * @dataProvider constructorOverridesPropertyTypeProvider
     */
    public function testConstructorOverridesPropertyType($property, array $type = null)
    {
        $extractor = $this->getExtractor();
        $this->assertEquals($type, $extractor->getTypes('Symfony\Component\PropertyInfo\Tests\Fixtures\ConstructorDummy', $property));
    }

    public function constructorOverridesPropertyTypeProvider()
    {
        return [
            ['timezone', [new Type(Type::BUILTIN_TYPE_OBJECT, false, 'DateTimeZone')]],
            ['date', [new Type(Type::BUILTIN_TYPE_INT)]],
            ['dateObject', [new Type(Type::BUILTIN_TYPE_OBJECT, false, 'DateTimeInterface')]],
            ['dateTime', [new Type(Type::BUILTIN_TYPE_OBJECT, false, 'DateTime')]],
            ['ddd', null],
        ];
    }

    /**
     * @return PropertyInfoExtractor
     */
    private function getExtractor()
    {
        $phpdocExtractor = new PhpDocExtractor();
        $reflectionExtractor = new ReflectionExtractor();
        $constructorExtractor = new ConstructorExtractor([$phpdocExtractor, $reflectionExtractor]);

        return new PropertyInfoExtractor([], [$constructorExtractor, $phpdocExtractor, $reflectionExtractor]);
    }
}
