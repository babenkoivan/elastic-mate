<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasSearchQuoteAnalyzer
{
    /**
     * @var string|null
     */
    private $searchQuoteAnalyzer;

    /**
     * @param string $searchQuoteAnalyzer
     * @return self
     */
    public function setSearchQuoteAnalyzer(string $searchQuoteAnalyzer): self
    {
        $this->searchQuoteAnalyzer = $searchQuoteAnalyzer;
        return $this;
    }
}
