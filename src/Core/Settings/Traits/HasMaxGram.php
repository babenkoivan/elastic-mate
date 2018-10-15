<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasMaxGram
{
    /**
     * @var int
     */
    private $maxGram = 2;

    /**
     * @param int $maxGram
     * @return self
     */
    public function setMaxGram(int $maxGram): self
    {
        $this->maxGram = $maxGram;
        return $this;
    }
}
