<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

use BabenkoIvan\ElasticMate\Core\Mapping\Mapping;

trait HasSimilarity
{
    /**
     * @var string
     */
    private $similarity = Mapping::SIMILARITY_BM25;

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
