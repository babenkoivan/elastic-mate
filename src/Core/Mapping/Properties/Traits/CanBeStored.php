<?php
declare(strict_types=1);

namespace BabenkoIvan\ElasticMate\Core\Mapping\Properties\Traits;

trait CanBeStored
{
    /**
     * @var bool
     */
    private $isStored = false;

    /**
     * @param bool $isStored
     * @return self
     */
    public function setStored(bool $isStored): self
    {
        $this->isStored = $isStored;
        return $this;
    }
}
