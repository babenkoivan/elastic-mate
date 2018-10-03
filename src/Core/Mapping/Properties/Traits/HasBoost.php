<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasBoost
{
    /**
     * @var float
     */
    private $boost = 1.0;

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
