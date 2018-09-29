<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use Illuminate\Support\Collection;

class Mapping implements Arrayable
{
    /**
     * @var Collection
     */
    private $properties;

    /**
     * @param Collection $properties
     */
    public function __construct(Collection $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $mapping = [];

        $properties = $this->properties->mapWithKeys(function (Property $property) {
            return [
                $property->getName() => $property->toArray()
            ];
        })->all();

        if (!empty($properties)) {
            $mapping['properties'] = $properties;
        }

        return $mapping;
    }
}
