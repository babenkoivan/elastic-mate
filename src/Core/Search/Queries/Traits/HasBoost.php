<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasBoost
{
    /**
     * @var float|null
     */
    protected $boost;

    /**
     * @param float $boost
     * @return self
     */
    public function setBoost(float $boost): self
    {
        $this->boost = $boost;
        return $this;
    }
}
