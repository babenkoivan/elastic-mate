<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasMaxExpansions
{
    /**
     * @var int
     */
    private $maxExpansions = 50;

    /**
     * @param int $maxExpansions
     * @return self
     */
    public function setMaxExpansions(int $maxExpansions): self
    {
        $this->maxExpansions = $maxExpansions;
        return $this;
    }
}
