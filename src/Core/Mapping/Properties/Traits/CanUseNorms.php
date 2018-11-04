<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanUseNorms
{
    /**
     * @var bool
     */
    private $norms = true;

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
