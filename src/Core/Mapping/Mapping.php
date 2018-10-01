<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use Illuminate\Support\Collection;

class Mapping implements Arrayable
{
    /**
     * @var bool
     */
    private $isSourceEnabled = true;

    /**
     * @var Collection
     */
    private $properties;

    public function __construct()
    {
        $this->properties = collect();
    }

    /**
     * @return self
     */
    public function disableSource(): self
    {
        $this->isSourceEnabled = false;
        return $this;
    }

    /**
     * @param Property $property
     * @return Mapping
     */
    public function addProperty(Property $property): self
    {
        $this->properties->push($property);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $mapping = [
            '_source' => [
                'enabled' => $this->isSourceEnabled
            ]
        ];

        $properties = $this->properties->mapWithKeys(function (Property $property) {
            return [
                $property->getName() => $property->toArray()
            ];
        });

        if ($properties->count() > 0) {
            $mapping['properties'] = $properties->all();
        }

        return $mapping;
    }
}
