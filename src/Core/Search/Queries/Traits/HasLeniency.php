<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Search\Queries\Traits;

trait HasLeniency
{
    /**
     * @var bool
     */
    private $isLenient = false;

    /**
     * @param bool $isLenient
     * @return self
     */
    public function setLenient(bool $isLenient): self
    {
        $this->isLenient = $isLenient;
        return $this;
    }
}
