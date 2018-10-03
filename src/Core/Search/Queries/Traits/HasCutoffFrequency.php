<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasCutoffFrequency
{
    /**
     * @var float|null
     */
    private $cutoffFrequency;

    /**
     * @param float $cutoffFrequency
     * @return self
     */
    public function setCutoffFrequency(float $cutoffFrequency): self
    {
        $this->cutoffFrequency = $cutoffFrequency;
        return $this;
    }
}
