<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\CharacterFilters;

use BabenkoIvan\ElasticMate\Core\Contracts\Settings\CharacterFilter;
use BabenkoIvan\ElasticMate\Core\Settings\Support\CharMapping;
use Illuminate\Support\Collection;

final class MappingCharacterFilter extends AbstractCharacterFilter
{
    /**
     * @var Collection
     */
    private $mappings;

    /**
     * @var string
     */
    private $mappingsPath;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->mappings = collect();
    }

    /**
     * @param CharMapping $mapping
     * @return self
     */
    public function addMapping(CharMapping $mapping): self
    {
        $this->mappings->push($mapping);
        return $this;
    }

    /**
     * @param string $mappingsPath
     * @return self
     */
    public function setMappingsPath(string $mappingsPath): self
    {
        $this->mappingsPath = $mappingsPath;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        $characterFilter = [
            'type' => CharacterFilter::TYPE_MAPPING
        ];

        if (isset($this->mappingsPath)) {
            $characterFilter['mappings_path'] = $this->mappingsPath;
        } else {
            $characterFilter['mappings'] = $this->mappings->map(function(CharMapping $mapping) {
                return $mapping->toString();
            })->values()->all();
        }

        return $characterFilter;
    }
}
