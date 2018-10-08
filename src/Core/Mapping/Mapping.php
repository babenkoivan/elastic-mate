<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping;

use BabenkoIvan\ElasticMate\Core\Contracts\Arrayable;
use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;
use Illuminate\Support\Collection;

class Mapping implements Arrayable
{
    const INDEX_OPTIONS_DOCS = 'docs';
    const INDEX_OPTIONS_FREQS = 'freqs';
    const INDEX_OPTIONS_POSITIONS = 'positions';
    const INDEX_OPTIONS_OFFSETS = 'offsets';

    const SIMILARITY_BM25 = 'BM25';
    const SIMILARITY_CLASSIC = 'classic';
    const SIMILARITY_BOOLEAN = 'boolean';

    const LOCALE_ROOT = 'ROOT';

    const TERM_VECTOR_NO = 'no';
    const TERM_VECTOR_YES = 'yes';
    const TERM_VECTOR_WITH_POSITIONS = 'with_positions';
    const TERM_VECTOR_WITH_OFFSETS = 'with_offsets';
    const TERM_VECTOR_WITH_POSITIONS_AND_OFFSETS = 'with_positions_offsets';

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
