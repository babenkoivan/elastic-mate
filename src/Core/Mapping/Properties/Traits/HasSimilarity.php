<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

use BabenkoIvan\ElasticMate\Core\Contracts\Mapping\Property;

trait HasSimilarity
{
    /**
     * @var string
     */
    private $similarity = Property::SIMILARITY_BM25;

    /**
     * @param string $similarity
     * @return self
     */
    public function setSimilarity(string $similarity): self
    {
        $this->similarity = $similarity;
        return $this;
    }
}
