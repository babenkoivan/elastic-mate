<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait HasNorms
{
    /**
     * @var bool
     */
    private $norms = false;

    /**
     * @param bool $norms
     * @return self
     */
    public function setNorms(bool $norms): self
    {
        $this->norms = $norms;
        return $this;
    }
}
