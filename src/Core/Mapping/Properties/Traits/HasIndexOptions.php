<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;

trait HasIndexOptions
{
    /**
     * @var string
     */
    private $indexOptions = Mapping::INDEX_OPTIONS_POSITIONS;

    /**
     * @param string $indexOptions
     * @return self
     */
    public function setIndexOptions(string $indexOptions): self
    {
        $this->indexOptions = $indexOptions;
        return $this;
    }
}
