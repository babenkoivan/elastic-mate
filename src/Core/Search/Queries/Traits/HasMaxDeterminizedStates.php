<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasMaxDeterminizedStates
{
    /**
     * @var int|null
     */
    private $maxDeterminizedStates;

    /**
     * @param int $maxDeterminizedStates
     * @return self
     */
    public function setMaxDeterminizedStates(int $maxDeterminizedStates): self
    {
        $this->maxDeterminizedStates = $maxDeterminizedStates;
        return $this;
    }
}
