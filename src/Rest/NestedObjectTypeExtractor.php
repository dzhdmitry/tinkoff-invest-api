<?php

namespace Dzhdmitry\TinkoffInvestApi\Rest;

use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\PropertyInfo\Type;

class NestedObjectTypeExtractor implements PropertyTypeExtractorInterface
{
    /**
     * @var array
     */
    private array $types;

    /**
     * @param array $types
     */
    public function __construct(array $types)
    {
        $this->types = $types;
    }

    /**
     * @inheritDoc
     */
    public function getTypes(string $class, string $property, array $context = [])
    {
        $valueType = $this->getValueType($class, $property);

        if ($valueType === null) {
            return null;
        }

        return [
            new Type(Type::BUILTIN_TYPE_ARRAY, false, null, true, null, new Type(Type::BUILTIN_TYPE_OBJECT, false, $valueType)),
        ];
    }

    /**
     * @param string $class
     * @param string $property
     *
     * @return string|null
     */
    private function getValueType(string $class, string $property): ?string
    {
        foreach ($this->types as $storedClass => $types) {
            if (is_a($class, $storedClass, true)) {
                foreach ($types as $storedProperty => $valueType) {
                    if ($storedProperty === $property) {
                        return $valueType;
                    }
                }
            }
        }

        return null;
    }
}
