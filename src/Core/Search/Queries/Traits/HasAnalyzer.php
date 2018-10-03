<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasAnalyzer
{
    /**
     * @var string|null
     */
    private $analyzer;

    /**
     * @param string $analyzer
     * @return self
     */
    public function setAnalyzer(string $analyzer): self
    {
        $this->analyzer = $analyzer;
        return $this;
    }
}
