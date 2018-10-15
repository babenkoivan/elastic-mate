<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Settings\Traits;

trait HasMinGram
{
    /**
     * @var int
     */
    private $minGram = 1;

    /**
     * @param int $minGram
     * @return self
     */
    public function setMinGram(int $minGram): self
    {
        $this->minGram = $minGram;
        return $this;
    }
}
