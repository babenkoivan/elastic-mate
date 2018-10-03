<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasSearchAnalyzer
{
    /**
     * @var string|null
     */
    private $searchAnalyzer;

    /**
     * @param string $searchAnalyzer
     * @return self
     */
    public function setSearchAnalyzer(string $searchAnalyzer): self
    {
        $this->searchAnalyzer = $searchAnalyzer;
        return $this;
    }
}
